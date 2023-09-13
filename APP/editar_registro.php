<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del registro a editar desde el formulario
    $registro_id = $_POST['registro_id'];

    // Recuperar los datos del registro de la base de datos
    $query = "SELECT * FROM registros WHERE id = :registro_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['registro_id' => $registro_id]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Procesar el formulario de edición
    if (isset($_POST['guardar_cambios'])) {
        // Obtener los datos editados del formulario
        $nombre = strtoupper($_POST['nombre']); // Convertir a mayúsculas
        $edad = $_POST['edad'];
        $fecha_primaria = $_POST['fecha_primaria'];
        $fecha_secundaria = $_POST['fecha_secundaria'];

        // Realizar la actualización en la base de datos
        $query = "UPDATE registros SET nombre = :nombre, edad = :edad, fecha_primaria = :fecha_primaria, fecha_secundaria = :fecha_secundaria WHERE id = :registro_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'nombre' => $nombre,
            'edad' => $edad,
            'fecha_primaria' => $fecha_primaria,
            'fecha_secundaria' => $fecha_secundaria,
            'registro_id' => $registro_id,
        ]);

        // Redirigir de vuelta a la lista de registros
        header("Location: list.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
    <h1>Editar Registro</h1>
    <form method="POST">
        <!-- Agrega un formulario para editar los datos del registro -->
        <input type="hidden" name="registro_id" value="<?= $registro['id'] ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $registro['nombre'] ?>" required><br>

        <label for="edad">Edad:</label>
        <input type="number" name="edad" value="<?= $registro['edad'] ?>" required><br>

        <label for="fecha_primaria">Fecha de Inicio de Estudios de Primaria:</label>
        <input type="date" name="fecha_primaria" value="<?= $registro['fecha_primaria'] ?>" required><br>

        <label for="fecha_secundaria">Fecha de Inicio de Estudios de Secundaria:</label>
        <input type="date" name="fecha_secundaria" value="<?= $registro['fecha_secundaria'] ?>" required><br>

        <button type="submit" name="guardar_cambios">Guardar Cambios</button>
    </form>
    <br>
    <a href="list.php">Volver a la Lista</a>
    </div>
    
</body>
</html>

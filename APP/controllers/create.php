<?php
include '../models/db.php';

// Inicializa las variables para almacenar los valores del formulario
$nombre = $edad = $fecha_primaria = $fecha_secundaria = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validación de datos ingresados por el usuario
    $nombre = strtoupper($_POST['nombre']); // Convertir a mayúsculas
    $edad = $_POST['edad'];
    $fecha_primaria = $_POST['fecha_primaria'];
    $fecha_secundaria = $_POST['fecha_secundaria'];

    // Validar la edad según tus condiciones
    if ($edad < 30 || $edad > 99) {
        $errors[] = "La edad debe estar entre 30 y 99 años.";
    }

    // Validar la diferencia de fechas
    $fecha_primaria_timestamp = strtotime($fecha_primaria);
    $fecha_secundaria_timestamp = strtotime($fecha_secundaria);
    
    if ($fecha_secundaria_timestamp - $fecha_primaria_timestamp > 9 * 365 * 24 * 60 * 60) {
        $errors[] = "La diferencia entre las fechas de inicio de estudios no puede ser mayor de 9 años.";
    }

    if ($fecha_secundaria_timestamp - $fecha_primaria_timestamp < 3 * 365 * 24 * 60 * 60) {
        $errors[] = "La diferencia entre las fechas de inicio de estudios no puede ser menor de 3 años.";
    }

    // Validar que el nombre esté en mayúsculas
    if ($nombre !== $_POST['nombre']) {
        $errors[] = "El nombre debe estar en mayúsculas.";
    }

    // Si no hay errores, insertar el registro en la base de datos
    if (empty($errors)) {
        // Obtener la fecha actual automáticamente
        $fecha_dia = date("Y-m-d");

        $query = "INSERT INTO registros (fecha_dia, nombre, edad, fecha_primaria, fecha_secundaria)
                  VALUES (:fecha_dia, :nombre, :edad, :fecha_primaria, :fecha_secundaria)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'fecha_dia' => $fecha_dia,
            'nombre' => $nombre,
            'edad' => $edad,
            'fecha_primaria' => $fecha_primaria,
            'fecha_secundaria' => $fecha_secundaria,
        ]);

        // Redireccionar a la página de lista después de la inserción
        header("Location: list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Registro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Crear Registro</h1>
        
        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="edad" class="form-label">Edad:</label>
                <input type="number" name="edad" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="fecha_primaria" class="form-label">Fecha de Inicio de Estudios de Primaria:</label>
                <input type="date" name="fecha_primaria" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="fecha_secundaria" class="form-label">Fecha de Inicio de Estudios de Secundaria:</label>
                <input type="date" name="fecha_secundaria" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        
        <div class="mt-4">
            <a href="list.php" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    </div>

    <footer class="bg-dark text-center text-white mt-4">
        <div class="container p-4">
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/isa%C3%AD-figueroa-5675bb146/" role="button">
                    <i class="fab fa-linkedin-in"></i>
                </a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/ifigueroa065" role="button">
                    <i class="fab fa-github"></i>
                </a>
            </section>
        </div>
        
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Isaí Figueroa | Desarrollador Web
        </div>
    </footer>
</body>
</html>

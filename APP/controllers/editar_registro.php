<?php
// Incluir el archivo de conexión a la base de datos
include '../models/db.php';

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Estilos personalizados para la página */
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Registro</h1>
        <form method="POST">
            <!-- Agrega un formulario para editar los datos del registro -->
            <input type="hidden" name="registro_id" value="<?= $registro['id'] ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?= $registro['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" name="edad" value="<?= $registro['edad'] ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_primaria">Fecha de Inicio de Estudios de Primaria:</label>
                <input type="date" class="form-control" name="fecha_primaria" value="<?= $registro['fecha_primaria'] ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_secundaria">Fecha de Inicio de Estudios de Secundaria:</label>
                <input type="date" class="form-control" name="fecha_secundaria" value="<?= $registro['fecha_secundaria'] ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="guardar_cambios">Guardar Cambios</button>
        </form>
        <br>
        <a href="list.php" class="btn btn-secondary">Volver a la Lista</a>
    </div>

    
    <div>

        <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
            

            <!-- Linkedin -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/isa%C3%AD-figueroa-5675bb146/" role="button"
                ><i class="fab fa-linkedin-in"></i
            ></a>

            <!-- Github -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/ifigueroa065" role="button"
                ><i class="fab fa-github"></i
            ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 
            <a >Isaí Figueroa | Desarrollador Web</a>
        </div>
        <!-- Copyright -->
        </footer>
  
    </div>
</body>
</html>

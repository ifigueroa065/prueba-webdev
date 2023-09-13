<?php
session_start();
include('db.php'); // Incluye la configuración de conexión desde db.php

// Inicializa la variable de mensaje de error
$mensaje_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena = md5($_POST["contrasena"]);

    try {
        // Consulta para verificar si el usuario ya existe
        $consulta_existencia = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ?";
        $stmt_existencia = $pdo->prepare($consulta_existencia);
        $stmt_existencia->execute([$nombre_usuario]);
        $existe_usuario = $stmt_existencia->fetchColumn();

        if ($existe_usuario) {
            $mensaje_error = "El nombre de usuario ya existe. Por favor, elige otro.";
        } else {
            // Si el usuario no existe, procede con el registro
            $query = "INSERT INTO usuarios (nombre_usuario, contrasena_md5) VALUES (?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nombre_usuario, $contrasena]);

            // Establece una variable de sesión para indicar el registro exitoso
            $_SESSION["registro_exitoso"] = true;
        }
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div  class="container-login">
        <h1>Registro de Usuario</h1>
        
        <!-- Muestra el mensaje de error en un cuadro de alerta -->
        <?php if (!empty($mensaje_error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensaje_error; ?>
            </div>
        <?php } ?>

        <form method="POST">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>
            
            <button type="submit">Registrarse</button>
        </form>
        <br>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
    
    <!-- Muestra el mensaje de registro exitoso en un cuadro de alerta -->
    <?php if (isset($_SESSION["registro_exitoso"]) && $_SESSION["registro_exitoso"]) { ?>
        <script>
            alert("Registro exitoso. Iniciar sesión");
        </script>
        <?php
        // Restablece la variable de sesión
        $_SESSION["registro_exitoso"] = false;
        ?>
    <?php } ?>
    
</body>
</html>

<?php
session_start();
include('db.php'); // Incluye la configuración de conexión desde bd.php

// Inicializa la variable de mensaje de error
$mensaje_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena = md5($_POST["contrasena"]);

    try {
        // Consulta para verificar las credenciales del usuario
        $query = "SELECT id, nombre_usuario FROM usuarios WHERE nombre_usuario = ? AND contrasena_md5 = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nombre_usuario, $contrasena]);

        if ($stmt->rowCount() == 1) {
            $fila = $stmt->fetch();
            $_SESSION["user_id"] = $fila["id"];
            $_SESSION["username"] = $fila["nombre_usuario"];
            header("Location: list.php");
            exit();
        } else {
            $mensaje_error = "Credenciales incorrectas. Intenta de nuevo.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div  class="container-login">
        <h1>Iniciar Sesión</h1>
        
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
            
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <br>
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
    </div>
    
</body>
</html>

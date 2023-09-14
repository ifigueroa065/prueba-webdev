<?php
session_start();
include('models/db.php'); // Incluye la configuración de conexión desde bd.php

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
            header("Location: controllers/list.php");
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- As a heading -->
    <nav  class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        
        <span class="navbar-brand mb-0 h1"><i class="fab fa-github"></i
            >  Prueba  | ISAI FIGUEROA</span>
    </div>
    </nav>
    <div class="container">
        
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="container-login p-4">
                    <h1 class="text-center">Iniciar Sesión</h1>
                    
                    <!-- Muestra el mensaje de error en un cuadro de alerta -->
                    <?php if (!empty($mensaje_error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje_error; ?>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de Usuario:</label>
                            <input type="text" name="nombre_usuario" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña:</label>
                            <input type="password" name="contrasena" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </form>
                    
                    <p class="text-center">¿No tienes una cuenta? <a href="controllers/register.php">Regístrate</a></p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div >

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

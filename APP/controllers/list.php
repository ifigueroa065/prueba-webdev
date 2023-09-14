<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

include '../models/db.php';

// Función para calcular y formatear la diferencia de fechas en años, meses y días
function obtenerDiferenciaFechas($fecha_inicio, $fecha_fin) {
    $diferencia = "";

    $fecha1 = new DateTime($fecha_inicio);
    $fecha2 = new DateTime($fecha_fin);

    $intervalo = $fecha1->diff($fecha2);

    if ($intervalo->y > 0) {
        $diferencia .= $intervalo->y . ' año(s) ';
    }

    if ($intervalo->m > 0) {
        $diferencia .= $intervalo->m . ' mes(es) ';
    }

    if ($intervalo->d > 0) {
        $diferencia .= $intervalo->d . ' día(s)';
    }

    return $diferencia;
}

// Consulta para obtener los periodos mensuales
$query_periodos = "SELECT DATE_FORMAT(fecha_dia, '%Y%b') AS periodo FROM registros GROUP BY DATE_FORMAT(fecha_dia, '%Y%b') ORDER BY MIN(fecha_dia) DESC";
$stmt_periodos = $pdo->prepare($query_periodos);
$stmt_periodos->execute();
$periodos = $stmt_periodos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener todos los registros con la diferencia de fechas calculada
$query_registros = "SELECT
    id,
    fecha_dia,
    nombre,
    edad,
    fecha_primaria,
    fecha_secundaria
FROM registros";

$stmt_registros = $pdo->prepare($query_registros);
$stmt_registros->execute();
$registros = $stmt_registros->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Registros</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
   
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
        <div class="sub">
            <h1>Bienvenido, <?php echo $_SESSION["username"]; ?></h1>
            <h1>Lista de Registros</h1>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha del Día</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Fecha de Inicio Primaria</th>
                    <th scope="col">Fecha de Inicio Secundaria</th>
                    <th scope="col">Diferencia del rango de Fechas</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro) { ?>
                    <tr>
                        <td><?= $registro['id'] ?></td>
                        <td><?= $registro['fecha_dia'] ?></td>
                        <td><?= $registro['nombre'] ?></td>
                        <td><?= $registro['edad'] ?></td>
                        <td><?= $registro['fecha_primaria'] ?></td>
                        <td><?= $registro['fecha_secundaria'] ?></td>
                        <td><?= obtenerDiferenciaFechas($registro['fecha_primaria'], $registro['fecha_secundaria']) ?></td>
                        <td>
                            <form method="POST" action="editar_registro.php">
                                <input type="hidden" name="registro_id" value="<?= $registro['id'] ?>">
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <form method="POST" action="eliminar_registro.php" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                <input type="hidden" name="registro_id" value="<?= $registro['id'] ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <!-- Botón "Mostrar Periodos Mensuales" para cada registro -->
                            <form method="POST" action="mostrar_periodos.php">
                                <input type="hidden" name="registro_id" value="<?= $registro['id'] ?>">
                                <button type="submit" class="btn btn-primary">Periodos Mensuales</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="create.php" class="btn btn-primary">Agregar Registro</a>
        <a href="../login.php" class="btn btn-secondary">Cerrar Sesión</a>
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
</body>
</html>
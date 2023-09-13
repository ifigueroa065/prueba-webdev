<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="sub">
            <h1>Bienvenido, <?php echo $_SESSION["username"]; ?></h1>
            <h1>Lista de Registros</h1>
        </div>


        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th> <!-- Nueva columna para mostrar el ID -->
                    <th scope="col">Fecha del Día</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Fecha de Inicio <br> Primaria</th>
                    <th scope="col">Fecha de Inicio <br> Secundaria</th>
                    <th>Diferencia <br> del rango de Fechas</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro) { ?>
                    <tr>
                        <td><?= $registro['id'] ?></td> <!-- Muestra el ID del registro -->
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
                        </td>
                        <td>
                            <form method="POST" action="eliminar_registro.php" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                <input type="hidden" name="registro_id" value="<?= $registro['id'] ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
            <br>
        </div>
        <a href="create.php">Agregar Registro |</a>
        <a href="login.php">Cerrar Sesión</a>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

include '../models/db.php';

if (isset($_POST["registro_id"])) {
    $registro_id = $_POST["registro_id"];
    
    // Consulta para obtener el registro seleccionado
    $query_registro = "SELECT
        id,
        fecha_primaria,
        fecha_secundaria
    FROM registros
    WHERE id = :registro_id";
    
    $stmt_registro = $pdo->prepare($query_registro);
    $stmt_registro->bindParam(":registro_id", $registro_id, PDO::PARAM_INT);
    $stmt_registro->execute();
    
    $registro = $stmt_registro->fetch(PDO::FETCH_ASSOC);
    
    if ($registro) {
        $fecha_inicio = new DateTime($registro['fecha_primaria']);
        $fecha_fin = new DateTime($registro['fecha_secundaria']);
        
        // Generar y mostrar los períodos mensuales
        $periodos_mensuales = generarPeriodosMensuales($fecha_inicio, $fecha_fin);
    } else {
        // Manejo de error si no se encuentra el registro
        echo "Registro no encontrado.";
    }
} else {
    // Manejo de error si no se proporciona el ID del registro
    echo "ID de registro no proporcionado.";
}

// Función para generar los períodos mensuales entre dos fechas
function generarPeriodosMensuales($fecha_inicio, $fecha_fin) {
    $periodos = [];

    while ($fecha_inicio <= $fecha_fin) {
        $periodo = $fecha_inicio->format('YM');
        $periodos[] = $periodo;
        $fecha_inicio->add(new DateInterval('P1M'));
    }

    return $periodos;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Periodos Mensuales</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="sub">
            <h2>Bienvenido, <?php echo $_SESSION["username"]; ?></h2>
            <p>Detalle de Periodos Mensuales</p>
        </div>
        
        <?php if (!empty($periodos_mensuales)) { ?>
            <div class="sub">
                <h3>Períodos Mensuales entre las fechas:</h3>
                <h4>Inicio: <?= $registro['fecha_primaria'] ?> | Fin: <?= $registro['fecha_secundaria'] ?></h4>
                
            </div>
            
            <div class="row">
                <?php $column_count = 4; // Número de columnas ?>
                <?php $per_column = ceil(count($periodos_mensuales) / $column_count); // Elementos por columna ?>

                <?php for ($i = 0; $i < $column_count; $i++) { ?>
                    <div class="col">
                        <ul>
                            <?php for ($j = $i * $per_column; $j < min(($i + 1) * $per_column, count($periodos_mensuales)); $j++) { ?>
                                <li><?= $periodos_mensuales[$j] ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No hay períodos mensuales disponibles.</p>
        <?php } ?>

        <a href="list.php">Volver a la Lista de Registros</a>
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

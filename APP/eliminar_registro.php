<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del registro a eliminar desde el formulario
    $registro_id = $_POST['registro_id'];

    // Preparar la consulta para eliminar el registro
    $query = "DELETE FROM registros WHERE id = :registro_id";
    $stmt = $pdo->prepare($query);

    // Ejecutar la consulta y pasar el ID del registro como parámetro
    $stmt->execute(['registro_id' => $registro_id]);

    // Redireccionar de nuevo a la página de lista después de eliminar el registro
    header("Location: list.php");
    exit();
} else {
    // Si se intenta acceder a este archivo directamente sin una solicitud POST, redirigir a la página de lista.
    header("Location: list.php");
    exit();
}

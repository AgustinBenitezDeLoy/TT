<?php


// Usando la conexión de 'conexion.php'
include 'conexion.php';

// Consulta para obtener las fiestas disponibles
$query = "SELECT id, nombre FROM fiestas";
$fiestas = $conn->query($query);

// Asegúrate de cerrar la conexión más adelante, después de usar $fiestas
?>

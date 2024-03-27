<?php
include 'conexion.php'; // Asume que este archivo contiene tu conexión a la base de datos
$fiestas = $conn->query("SELECT id, nombre FROM fiestas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar Entrada</title>
</head>
<body>
    <h2>Publicar Nueva Entrada</h2>
    <form action="procesar_entrada.php" method="post" enctype="multipart/form-data">
        <label for="fiesta">Fiesta:</label>
        <select id="fiesta" name="fiesta" required>
            <?php while ($fiesta = $fiestas->fetch_assoc()): ?>
                <option value="<?= $fiesta['id'] ?>"><?= $fiesta['nombre'] ?></option>
            <?php endwhile; ?>
        </select><br>
        
        <label for="tipo_entrada">Tipo de Entrada:</label>
        <select id="tipo_entrada" name="tipo_entrada" required>
            <option value="VIP">VIP</option>
            <option value="Backstage">Backstage</option>
            <option value="Campo">Campo</option>
        </select><br>
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required><br>

        <label for="qr">Archivo QR:</label>
        <input type="file" id="qr" name="qr" required><br>

        <input type="submit" value="Publicar Entrada">
    </form>
</body>
</html>


<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fiestaId = $_POST['fiesta'];
    $tipoEntrada = $_POST['tipo_entrada'];
    $precio = $_POST['precio'];
    $qr = $_FILES['qr'];

    // Verificar que el precio no exceda el máximo permitido para la fiesta
    $stmt = $conn->prepare("SELECT precio_maximo FROM fiestas WHERE id = ?");
    $stmt->bind_param("i", $fiestaId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();
    if ($precio > $fila['precio_maximo']) {
        echo "El precio excede el máximo permitido para esta fiesta.";
        exit;
    }

    // Procesar el archivo QR
    $directorio = "qr/";
    $nombreArchivo = $directorio . basename($qr['name']);

    // Mover archivo QR al directorio
    if (move_uploaded_file($qr['tmp_name'], $nombreArchivo)) {
        // Insertar la entrada en la base de datos
        $stmt = $conn->prepare("INSERT INTO entradas (fiesta, tipo_entrada, precio, qr) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $fiestaId, $tipoEntrada, $precio, $nombreArchivo);

        if ($stmt->execute()) {
            echo "Entrada publicada con éxito.";
        } else {
            echo "Hubo un error al guardar la entrada en la base de datos.";
        }
    } else {
        echo "Hubo un error al subir el archivo QR.";
    }
} else {
    echo "Método no permitido.";
}
?>

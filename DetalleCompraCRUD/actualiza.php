<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$precio = $conn->real_escape_string($_POST['precio']);
$precio_float = floatval($precio);
$cantidad = $conn->real_escape_string($_POST['cantidad']);


$sql = $conn->prepare("CALL sp_ActualizarDetalleCompra(?,?,?)");
$sql->bind_param("idi", $id, $precio_float,$cantidad);

$sql->execute();

if ($sql->affected_rows > 0) {
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro actualizado";
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al actualizar registro";
}

$sql->close();
$conn->close();


header('Location: detalle_compra.php');

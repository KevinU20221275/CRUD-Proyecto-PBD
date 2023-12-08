<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = $conn->prepare("CALL sp_EliminarDetalleCompra(?)");
$sql->bind_param("i", $id);

$sql->execute();

if ($sql->affected_rows > 0) {
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro eliminado";
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al eliminar registro";
}

$sql->close();
$conn->close();
header('Location: detalle_compra.php');

<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$status = $conn->real_escape_string($_POST['status']);
$email = $conn->real_escape_string($_POST['email']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$total = $conn->real_escape_string($_POST['total']);



$sql = $conn->prepare("CALL sp_ActualizarCompra_CRUD(?,?,?,?,?)");
$sql->bind_param("isssd", $id, $status,$email, $direccion,$total);

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


header('Location: compras.php');

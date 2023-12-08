<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$nombres = $conn->real_escape_string($_POST['nombres']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$direccion = $conn->real_escape_string($_POST['direccion']);


$sql = $conn->prepare("CALL sp_ActualizarCliente(?, ?, ?, ?, ?, ?)");
$sql->bind_param("isssss", $id, $nombres, $apellidos, $email, $telefono, $direccion);

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


header('Location: clientes.php');

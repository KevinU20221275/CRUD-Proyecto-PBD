<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$nombreUsuario = $conn->real_escape_string($_POST['nombreUsuario']);
$password = $conn->real_escape_string($_POST['password']);


$sql = $conn->prepare("CALL sp_ActualizarAdministrador(?,?,?,?,?,?,?,?)");
$sql->bind_param("isssssss", $id, $nombre,$apellidos,$email,$telefono,$direccion,$nombreUsuario,$password);

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


header('Location: administradores.php');

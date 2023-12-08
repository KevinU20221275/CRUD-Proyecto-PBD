<?php

session_start();

require '../config/database.php';

$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$nombreUsuario = $conn->real_escape_string($_POST['nombreUsuario']);
$password = $conn->real_escape_string($_POST['password']);

if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
} else {
    $imagen = NULL;
}


$query= "CALL sp_InsertarAdministrador ('$nombre','$apellidos','$email','$telefono','$direccion', '$nombreUsuario','$password','$imagen')";
$result = $conn->query($query);

if($result){
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";
} else {
        $_SESSION['color'] = "danger";
        $_SESSION['msg'] = "Error al guarda registro";
}

header('Location: administradores.php');
?>
<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);
$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

$sql = "UPDATE administrador SET imagen='$imagen' WHERE id=$id";
if ($conn->query($sql)) {
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Imagen actualizada";
    }
 else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al actualizar la Imagen";
}


header('Location: administradores.php');

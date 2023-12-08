<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$nombre = $conn->real_escape_string($_POST['nombre']);

$sql = $conn->prepare("CALL sp_ActualizarCategoria(?,?)");
$sql->bind_param("is", $id, $nombre);

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


header('Location: categorias.php');

<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = $conn->real_escape_string($_POST['precio']);
$descuento = $conn->real_escape_string($_POST['descuento']);
$id_categoria = $conn->real_escape_string($_POST['categoria']);



$sql = $conn->prepare("CALL sp_ActualizarProducto(?,?,?,?,?,?)");
$sql->bind_param("issdii", $id,$nombre,$descripcion,$precio,$descuento, $id_categoria);

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

header('Location: productos.php');






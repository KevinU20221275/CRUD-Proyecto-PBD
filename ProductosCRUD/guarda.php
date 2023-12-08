<?php

session_start();

require '../config/database.php';

$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = $_POST['precio'];
$precio_float = floatval($precio);
$descuento = $conn->real_escape_string($_POST['descuento']);
$categoria = $_POST['categoria'];
$id_Categoria = intval($categoria);


// si el input de la imagen viene vacio
if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
} else {
    $imagen = NULL;
}


$query= "CALL sp_InsertarProducto ('$nombre','$descripcion',$precio_float,$descuento, '$id_Categoria','$imagen')";
$result = $conn->query($query);

if($result){
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";
} else {
        $_SESSION['color'] = "danger";
        $_SESSION['msg'] = "Error al guarda imágen";
}

header('Location: productos.php');
?>
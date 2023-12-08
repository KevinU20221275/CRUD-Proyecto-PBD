<?php

session_start();

require '../config/database.php';

$nombre = $conn->real_escape_string($_POST['nombre']);


$query= "CALL sp_InsertarCategoria ('$nombre')";
$result = $conn->query($query);

if($result){
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";
} else {
        $_SESSION['color'] = "danger";
        $_SESSION['msg'] = "Error al guarda imágen";
}

header('Location: categorias.php');
?>
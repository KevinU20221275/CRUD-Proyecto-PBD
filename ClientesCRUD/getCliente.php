<?php

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);
$query = mysqli_query($conn, "SELECT id, Nombres,Apellidos,Email,Telefono,Direccion FROM vw_cliente_CRUD WHERE id=$id LIMIT 1");

if ($query) {

    if (mysqli_num_rows($query) > 0) {
        $producto = mysqli_fetch_assoc($query);
        echo json_encode($producto);
    } else {

        echo json_encode([]);
    }
} else {

    echo json_encode(['error' => mysqli_error($conn)]);
}


?>
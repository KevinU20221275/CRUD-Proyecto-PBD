<?php
$conn = new mysqli("localhost","root","","tienda_Online","3307");

if ($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
}

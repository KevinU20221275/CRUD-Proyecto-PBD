<?php

function validarPassword($password, $repassword){
    if (strcmp($password, $repassword) === 0){
        return true;
    }
    return false;
}

// si el usuario ya existe
function validarUsuario($usuario, $conexion){
    $query = $conexion->prepare("SELECT id FROM usuarios WHERE NombreUsuario LIKE ? LIMIT 1");
    $usuario = "%" . $usuario . "%"; // Agregamos los comodines % al valor de usuario
    $query->bind_param("s", $usuario);
    $query->execute();
    $query->store_result();  // Almacenamos el resultado para poder obtener el número de filas
    if ($query->num_rows > 0){
        return true;
    }
    return false;
}

function loginUsuario($usuario, $password, $conexion, $proceso){
    $query = $conexion->prepare("SELECT id, NombreUsuario, password, id_cliente FROM Usuarios WHERE NombreUsuario LIKE ? LIMIT 1");
    $usuario = "%" . $usuario . "%";
    $query->bind_param("s", $usuario);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0){
        $query->bind_result($id, $NombreUsuario, $hashed_password, $id_cliente);
        $query->fetch();

        if (password_verify($password, $hashed_password)){
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $NombreUsuario;
            $_SESSION['user_cliente'] = $id_cliente;
            if ($proceso == 'pago') {
                header("Location: pago.php");
            } else {
                header("Location: ../index.php");
                exit;
            }
        } else {
            return 'Usuario o Contraseña incorrectos';
        }
    } else {
        return 'Usuario o Contraseña incorrectos';
    }
}
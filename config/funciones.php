<?php

function campoNulo(array $campos){
    foreach ($campos as $campo){
        if (strlen(trim($campo)) < 1){
            return true;
        }
        return false;
    }
}


function mostrarErrores(array $errors){
    if (count($errors) > 0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors as $error){
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button></div>';
        
    }
}

function loginAdministrador($usuario, $password, $conexion){
    $sql = "CALL sp_LoginAdministrador (?,?,@id_admin, @admin_name, @contador);";
    $query = $conexion->prepare($sql);
    $query->bind_param("ss", $usuario,$password);
    $query->execute();

    $result = $conexion->query("SELECT @id_admin AS admin_id, @admin_name as admin_name,@contador AS contador");
    $row = $result->fetch_assoc();

    $contador = isset($row['contador']) ? $row['contador'] : 0;

    if ($contador > 0){
        $id = $row['admin_id'];
        $NombreUsuario = $row['admin_name'];
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_name'] = $NombreUsuario;
        return true;
    } else {
        return 'Usuario o Contraseña incorrectos';
        $query->close();
    }
    
    $conexion->close();
}

?>
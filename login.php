<?php
require './config/database.php';
require './config/funciones.php';

$errors = [];
if (!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);


    if (campoNulo([$usuario, $password])){
        $errors []= "Debe llenar todos los campos";
    };

    if (count($errors) == 0){
        if(loginAdministrador($usuario, $password, $conn)){
            header("Location: index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--==================== UNICONS ====================-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Nav</title>
</head>
<body class="body d-flex justify-content-center aling-items-center h-100" style="height: 100vh;">
    
    <main class="form-login m-auto mt-5 pt-5">
        <h2>Iniciar sesion</h2>
        <?php mostrarErrores($errors) ?>
        <form action="login.php" class="row g-3" method="post" autocomplete="off">
            <div class="form-floating">
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario">
                <label for="usuario">Usuario</label>
            </div>

            <div class="form-floating">
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">
                <label for="password">Contraseña</label>
            </div>

            <div class="col-12">
                <a href="#">Olvidaste tu contraseña?</a>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
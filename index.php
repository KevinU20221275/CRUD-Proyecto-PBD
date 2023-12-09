<?php
require("./config/database.php");
if (empty($_SESSION['admin_id'])){
    header("location: login.php"); // para cuando quiera validar los usuarios
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CRUD</title>
</head>
<style>
    nav {
        max-width: 1200px;
        margin: 0 auto;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 50px;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
        gap: 0.5rem;
    }
    .enlace {
        text-decoration: none;
        color: #fff;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all  .2s;
    }
    .enlace:hover {
        font-size: 20px;
        color: blue;
    }
</style>
<body>
    <header class="bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Home</a>
              <a href="./config/logout.php" class="text-danger navbar-brand">Cerrar Sesion</a>
                
              </div>
            </div>
        </nav>
    </header>
    <h2 class="text-center mt-2">Bienvenido <?php echo $_SESSION["admin_name"] ?></h2>
    <main class="container grid">
        <a href="./AdministradorCRUD/administradores.php" class="enlace bg-danger">Administrador</a>
        <a href="./ClientesCRUD/clientes.php" class="enlace bg-success">Clientes</a>
        <a href="./ProductosCRUD/productos.php" class="enlace bg-warning">Productos</a>
        <a href="./CategoriasCRUD/categorias.php" class="enlace bg-black">Categorias</a>
        <a href="./ComprasCRUD/compras.php" class="enlace bg-info">Compras</a>
        <a href="./DetalleCompraCRUD/detalle_compra.php" class="enlace bg-secondary">Detalle de Compras</a>
    </main>
</body>
</html>



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
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                  </li>
                </ul> -->
                
              </div>
            </div>
        </nav>
    </header>
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



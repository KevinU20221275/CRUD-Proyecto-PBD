<?php

session_start();

require '../config/database.php';

?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos CRUD</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column h-100">
    <?php include('../config/moduloNav.php')?>

    <div class="container py-3">

        <h2 class="text-center">Productos</h2>

        <hr>

        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <div class="row justify-content-between">
            <div class="col-auto d-flex">
                <label for="campo" class="col-form-label">Buscar: </label>
                <input type="text" name="campo" id="campo" class="form-control">
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-file-earmark-plus"></i> Nuevo registro</a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#id</th>
                    <th>Nombre</th>
                    <th width="30%">Descripción</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>categoria</th>
                    <th>imagen</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody id="content">
                
            </tbody>
        </table>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <p class="text-center"></p>
        </div>
    </footer>

    <?php
    $sqlCategoria = "SELECT * FROM vw_categoria_CRUD";
    $categorias = $conn->query($sqlCategoria);
    ?>

    <?php include 'createModal.php'; ?>

    <?php $categorias->data_seek(0); ?>
    <?php include 'modalUpdateImagen.php'; ?>
    <?php include 'updateModal.php'; ?>
    <?php include 'deleteModal.php'; ?>

    <script>
        let createModal = document.getElementById('createModal')
        let updateModal = document.getElementById('updateModal')
        let deleteModal = document.getElementById('deleteModal')
        let updateImagenModal =document.getElementById('updateImagenModal')

        createModal.addEventListener('shown.bs.modal', event => {
            createModal.querySelector('.modal-body #nombre').focus()
        })

        createModal.addEventListener('hide.bs.modal', event => {
            createModal.querySelector('.modal-body #nombre').value=""
            createModal.querySelector('.modal-body #descripcion').value=""
            createModal.querySelector('.modal-body #precio').value=""
            createModal.querySelector('.modal-body #descuento').value=""
            createModal.querySelector('.modal-body #categoria').value=""
            createModal.querySelector('.modal-body #imagen').value=""
        })

        updateModal.addEventListener('hide.bs.modal', event => {
            updateModal.querySelector('.modal-body #nombre').value = ""
            updateModal.querySelector('.modal-body #descripcion').value = ""
            updateModal.querySelector('.modal-body #precio').value = ""
            updateModal.querySelector('.modal-body #descuento').value = ""
            updateModal.querySelector('.modal-body #categoria').value = ""
        })

        updateModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id')

            let inputId = updateModal.querySelector('.modal-body #id')
            let inputNombre = updateModal.querySelector('.modal-body #nombre')
            let inputDescripcion = updateModal.querySelector('.modal-body #descripcion')
            let inputPrecio = updateModal.querySelector('.modal-body #precio')
            let inputDescuento = updateModal.querySelector('.modal-body #descuento')
            let inputCategoria = updateModal.querySelector('.modal-body #categoria')

            let url = "getProduct.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                inputId.value = data.id
                inputNombre.value = data.nombre
                inputDescripcion.value = data.descripcion
                inputPrecio.value = data.precio
                inputDescuento.value = data.descuento
                inputCategoria.value = data.id_categoria
            })
        })

        updateImagenModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            updateImagenModal.querySelector('.modal-body #id').value = id
        })

        deleteModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            deleteModal.querySelector('.modal-footer #id').value = id
        })
        /* listado de datos*/
        getData()

        document.getElementById("campo").addEventListener("keyup", function() {
            getData()
        }, false)

        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")

            let url = "../config/loadProductos.php"
            let formaData = new FormData()
            formaData.append('campo', input)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data
                })
        }
    </script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
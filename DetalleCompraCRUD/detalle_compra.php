<?php

require '../config/database.php';
if (empty($_SESSION['admin_id'])){
    header("location: ../login.php"); // para cuando quiera validar los usuarios
};
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle  de Compras CRUD</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column h-100">
    <?php include('../config/moduloNav.php')?>

    <div class="container py-3">

        <h2 class="text-center">Detalle de Compras</h2>

        <hr>
        <div class="row g-4">
            <div class="col-auto">
                <label for="campo" class="col-form-label">Buscar: </label>
            </div>
            <div class="col-auto">
                <input type="text" name="campo" id="campo" class="form-control">
            </div>
        </div>

        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#id</th>
                    <th>#id_compra</th>
                    <th>id_producto</th>
                    <th>Nombre Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
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

    <?php include 'updateModal.php'; ?>
    <?php include 'deleteModal.php'; ?>

    <script>
        let updateModal = document.getElementById('updateModal')
        let deleteModal = document.getElementById('deleteModal')

        updateModal.addEventListener('hide.bs.modal', event => {
            updateModal.querySelector('.modal-body #precio').value = ""
            updateModal.querySelector('.modal-body #cantidad').value = ""
        })

        updateModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id')

            let inputId = updateModal.querySelector('.modal-body #id')
            let inputPrecio = updateModal.querySelector('.modal-body #precio')
            let inputCantidad = updateModal.querySelector('.modal-body #cantidad')

            let url = "getDetalleCompra.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                inputId.value = data.id
                inputPrecio.value = data.precio
                inputCantidad.value = data.cantidad
            })
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

            let url = "../config/loadDetalleCompra.php"
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
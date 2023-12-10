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
    <title>Comentarios Productos CRUD</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column h-100">
    <?php include('../config/moduloNav.php')?>

    <div class="container py-3">

        <h2 class="text-center">Comentarios Productos</h2>

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
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#id</th>
                    <th>Producto</th>
                    <th>Cliente</th>
                    <th width="22%">Comentario</th>
                    <th>Calficacion</th>
                    <th>Fecha</th>
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

    <?php include 'deleteModal.php'; ?>

    <script>
        let deleteModal = document.getElementById('deleteModal')

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

            let url = "../config/loadComentarios.php"
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
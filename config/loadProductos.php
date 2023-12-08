<?php
require 'database.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id', 'Nombre', 'Descripcion', 'Precio','Descuento','Categoria', 'imagen'];

/* no es necesrio buscar por imagen por eso cree este otro arreglo para el WHERE */
$columnsbusqueda = ['id', 'Nombre', 'Descripcion', 'Precio','Descuento','Categoria'];
/* Nombre de la vista */
$vista = "vw_productos_CRUD";

$id = 'id';

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$where = '';

if ($campo != NULL){
    $where = "WHERE (";

    $cont = count($columnsbusqueda);
    for($i = 0; $i < $cont; $i++){
        $where .= $columnsbusqueda[$i] . " LIKE '%". $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$sql = "SELECT " . implode(", ", $columns) . " FROM $vista $where ";

$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['id'] . '</td>';
        $html .= '<td>' . $row['Nombre'] . '</td>';
        $html .= '<td width="32%">' . $row['Descripcion'] . '</td>';
        $html .= '<td>' . $row['Precio'] . '</td>';
        $html .= '<td>' . $row['Descuento'] . '% </td>';
        $html .= '<td>' . $row['Categoria'] . '</td>';
        $html .= '<td><img src="data:image/jpg;base64,' . base64_encode($row['imagen']) . '" alt="" class="img-card" width="50px"></td>';
        $html .= '<td><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-id="' . $row['id'] . '"><i class="bi bi-pencil-square"></i>Editar</a>
                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="' . $row['id'] . '"><i class="bi-solid bi-trash"></i> Eliminar</a>
                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#updateImagenModal" data-bs-id="' . $row['id'] . '"><i class="bi bi-pencil-square"></i> Img</a>
                  </td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);



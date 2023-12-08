<?php
require 'database.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id', 'Nombre'];

/* Nombre de la vista */
$vista = "vw_categoria_CRUD";

$id = 'id';

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$where = '';

if ($campo != NULL){
    $where = "WHERE (";

    $cont = count($columns);
    for($i = 0; $i < $cont; $i++){
        $where .= $columns[$i] . " LIKE '%". $campo . "%' OR ";
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
        $html .= '<td width="20%">' . $row['id'] . '</td>';
        $html .= '<td width="60%">' . $row['Nombre'] . '</td>';
        $html .= '<td width="20%"><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-id="' . $row['id'] . '"><i class="bi bi-pencil-square"></i> Editar</a>
                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="' . $row['id'] . '"><i class="bi-solid bi-trash"></i></i> Eliminar</a>
                  </td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);



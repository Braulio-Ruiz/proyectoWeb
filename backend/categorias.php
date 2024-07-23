<?php
/* @autor Braulio Ruiz */
include '../class/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;

    if ($nombre) {
        $categoria = new Categorias();
        $categoria->setNombre($nombre);
        $categoria->guardar();
        header('Location: views/lista_categorias.php');
        exit;
    } else {
        echo "Error: Datos no proporcionados.";
    }
}

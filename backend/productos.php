<?php
/* @autor Braulio Ruiz */
include '../class/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
    $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null;

    if ($nombre && $descripcion && $precio && $categoria_id && isset($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $target_dir = "../assets/img/";
        $target_file = $target_dir . basename($imagen);

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            $producto = new Productos();
            $producto->setNombre($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setImagen($imagen);
            $producto->setPrecio($precio);
            $producto->setCategoriaId($categoria_id);
            $producto->guardar();

            header('Location: views/lista_productos.php');
            exit;
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Error: Datos no proporcionados.";
    }
}

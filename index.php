<?php
/* @autor Braulio Ruiz */

include 'class/autoload.php';

$producto = new Productos();
$productos = $producto->obtenerTodos();

include 'views/home.php';
exit;

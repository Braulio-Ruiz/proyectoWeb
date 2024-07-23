<?php
/* @autor Braulio Ruiz */

// Incluye el archivo autoload.php, que se encarga de cargar automáticamente las clases necesarias.
// Este archivo debe estar configurado para buscar las clases en la carpeta 'class'.
include 'class/autoload.php';

// Crea una nueva instancia de la clase 'Productos'.
// Esta clase debe estar definida en uno de los archivos de la carpeta 'class' y cargada por el autoload.
$producto = new Productos();

// Llama al método 'obtenerTodos' de la instancia de 'Productos'.
// Este método debe estar definido en la clase 'Productos' y es responsable de obtener todos los productos de la base de datos o cualquier otra fuente de datos.
// El resultado, presumiblemente una lista de productos, se almacena en la variable '$productos'.
$productos = $producto->obtenerTodos();

// Incluye el archivo 'home.php' que se encuentra en la carpeta 'views'.
// Este archivo es responsable de generar y mostrar el HTML de la página de inicio del sitio web.
// Se espera que el archivo 'home.php' utilice la variable '$productos' para mostrar la lista de productos.
include 'views/home.php';

// Esto asegura que no se ejecutará ningún código adicional después de la inclusión de 'home.php'.
exit;

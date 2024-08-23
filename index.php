<?php

// Verifica si el archivo autoload.php existe antes de intentar cargarlo.
if (file_exists('class/autoload.php')) {
    // Incluye el archivo autoload.php una vez para cargar automáticamente las clases necesarias.
    require_once 'class/autoload.php';
} else {
    // Si el archivo no existe, muestra un mensaje de error y detiene la ejecución.
    die('Error: El archivo autoload.php no se encuentra.');
}

// Verifica si el archivo home.php existe antes de intentar cargarlo.
if (file_exists('views/home.php')) {
    // Incluye el archivo home.php para mostrar la página de inicio.
    require_once 'views/home.php';
} else {
    // Si el archivo no existe, muestra un mensaje de error y detiene la ejecución.
    die('Error: El archivo home.php no se encuentra.');
}

// Termina la ejecución del script para evitar la ejecución de código adicional.
exit;

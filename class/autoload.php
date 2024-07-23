<?php
// Inicia el script PHP

// Registra una función de autoloading para clases utilizando spl_autoload_register
// Esta función será llamada automáticamente siempre que se intente utilizar una clase que no ha sido definida todavía
spl_autoload_register(function ($class_name) {
    // La función de autoload toma el nombre de la clase que se está intentando utilizar ($class_name)

    // Incluye el archivo que contiene la definición de la clase
    // Supone que el archivo se llama igual que la clase y tiene una extensión .php
    include $class_name . '.php';
    // Esto significa que si se intenta usar una clase llamada 'Producto',
    // PHP intentará incluir un archivo llamado 'Producto.php'
});

// Fin del script PHP

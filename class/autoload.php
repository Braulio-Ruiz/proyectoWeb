<?php

// Registrar la función de autoload para cargar clases automáticamente.
spl_autoload_register(function ($class_name) {
    // Generar la ruta del archivo de clase basada en el nombre de la clase.
    $file = __DIR__ . '/' . $class_name . '.php';
    // Verificar si el archivo existe antes de incluirlo.
    if (file_exists($file)) {
        include $file;
    } else {
        // Manejar la excepción si el archivo no se encuentra.
        throw new Exception("No se puede cargar la clase: $class_name");
    }
});

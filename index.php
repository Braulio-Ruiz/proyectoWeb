<?php
// Incluye el archivo autoload.php, que se encarga de cargar automáticamente las clases necesarias.
// Este archivo debe estar configurado para buscar las clases en la carpeta 'class'.
include 'class/autoload.php';

// Incluye el archivo 'home.php' que se encuentra en la carpeta 'views'.
// Este archivo es responsable de generar y mostrar el HTML de la página de inicio del sitio web.
include 'views/home.php';

// Termina la ejecución del script.
// Esto asegura que no se ejecutará ningún código adicional después de la inclusión de 'home.php'.
exit;

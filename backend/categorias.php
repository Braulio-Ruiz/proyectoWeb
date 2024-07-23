<?php
/* @autor Braulio Ruiz */
// Comentario para indicar el autor del código.

include '../class/autoload.php';
// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    // Asigna el valor de 'nombre' del formulario POST a la variable $nombre, o null si no está definido.

    if ($nombre) {
        // Verifica si la variable $nombre tiene un valor.

        $categoria = new Categorias();
        // Crea una nueva instancia de la clase Categorias.

        $categoria->setNombre($nombre);
        // Establece el nombre de la categoría usando el método setNombre().

        $categoria->guardar();
        // Guarda la categoría en la base de datos usando el método guardar().

        header('Location: views/lista_categorias.php');
        // Redirige al usuario a la página 'lista_categorias.php' en el directorio 'views/'.

        exit;
        // Finaliza el script para asegurar que no se ejecute ningún código adicional.
    } else {
        echo "Error: Datos no proporcionados.";
        // Si no se proporcionaron todos los datos necesarios, muestra un mensaje de error.
    }
}

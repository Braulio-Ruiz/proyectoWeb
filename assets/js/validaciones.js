/* Validaciones para los formularios de categorías y productos */
/* Creado por Braulio Ruiz Niñoles */

// Esta función se ejecuta cuando el documento HTML está completamente cargado y listo.
$(document).ready(function () {

    // Validación en tiempo real del formulario
    $("#formCategorias input, #formProductos input").on('keyup blur', function () {
        var $this = $(this);
        if ($this.val().trim() === "") {
            $this.addClass('error');  // Añadir clase de error al campo vacío
        } else {
            $this.removeClass('error');  // Eliminar clase de error si el campo no está vacío
        }
    });

    // Validación del formulario de categorías
    $("#formCategorias").submit(function (event) {
        // Esta función se ejecuta cuando el formulario con id "formCategorias" se envía.

        event.preventDefault();
        // Evita el comportamiento predeterminado del formulario de enviar datos al servidor.

        // Obtener los valores de los campos
        var nombreCategoria = $("#nombreCategoria").val().trim();
        // Obtiene el valor del campo con id "nombreCategoria" y elimina los espacios en blanco de ambos extremos.

        // Verificar si los campos están vacíos
        var errores = [];
        // Crea un array vacío para almacenar los nombres de los campos que están vacíos.

        if (nombreCategoria === "") {
            errores.push("Nombre de la Categoría");
            // Si el campo "nombreCategoria" está vacío, añade un mensaje de error al array.
        }

        // Mostrar errores si existen
        if (errores.length > 0) {
            alert("Completar los siguientes campos: " + errores.join(", ") + "." + '\n\nCreado por Braulio Ruiz Niñoles');
            // Si hay errores, muestra una alerta con los nombres de los campos vacíos.
            return false;
            // Detiene el envío del formulario.
        }

        // Si no hay errores, permitir el envío del formulario
        this.submit();
        // Si no hay errores, envía el formulario.
    });

    // Validación del formulario de productos
    $("#formProductos").submit(function (event) {
        // Esta función se ejecuta cuando el formulario con id "formProductos" se envía.

        event.preventDefault();
        // Evita el comportamiento predeterminado del formulario de enviar datos al servidor.

        // Obtener los valores de los campos
        var nombreProducto = $("#nombreProducto").val().trim();
        // Obtiene el valor del campo con id "nombreProducto" y elimina los espacios en blanco de ambos extremos.

        var descripcionProducto = $("#descripcionProducto").val().trim();
        // Obtiene el valor del campo con id "descripcionProducto" y elimina los espacios en blanco de ambos extremos.

        var imagenProducto = $("#imagenProducto").val().trim();
        // Obtiene el valor del campo con id "imagenProducto" y elimina los espacios en blanco de ambos extremos.

        var precioProducto = $("#precioProducto").val().trim();
        // Obtiene el valor del campo con id "precioProducto" y elimina los espacios en blanco de ambos extremos.

        var categoriaProducto = $("#categoriaProducto").val().trim();
        // Obtiene el valor del campo con id "categoriaProducto" y elimina los espacios en blanco de ambos extremos.

        // Verificar si los campos están vacíos
        var errores = [];
        // Crea un array vacío para almacenar los nombres de los campos que están vacíos.

        if (nombreProducto === "") {
            errores.push("Nombre del Producto");
            // Si el campo "nombreProducto" está vacío, añade un mensaje de error al array.
        }
        if (descripcionProducto === "") {
            errores.push("Descripción del Producto");
            // Si el campo "descripcionProducto" está vacío, añade un mensaje de error al array.
        }
        if (imagenProducto === "") {
            errores.push("Imagen del Producto");
            // Si el campo "imagenProducto" está vacío, añade un mensaje de error al array.
        }
        if (precioProducto === "") {
            errores.push("Precio del Producto");
            // Si el campo "precioProducto" está vacío, añade un mensaje de error al array.
        }
        if (categoriaProducto === "") {
            errores.push("Categoría del Producto");
            // Si el campo "categoriaProducto" está vacío, añade un mensaje de error al array.
        }

        // Mostrar errores si existen
        if (errores.length > 0) {
            alert("Completar los siguientes campos: " + errores.join(", ") + "." + '\n\nCreado por Braulio Ruiz Niñoles');
            // Si hay errores, muestra una alerta con los nombres de los campos vacíos.
            return false;
            // Detiene el envío del formulario.
        }

        // Si no hay errores, permitir el envío del formulario
        this.submit();
        // Si no hay errores, envía el formulario.
    });

    // Confirmación al hacer clic en el botón "Cancelar"
    $('.btn-cancelar').on('click', function (event) {
        // Esta función se ejecuta cuando se hace clic en un elemento con la clase "btn-cancelar".

        event.preventDefault();
        // Evita el comportamiento predeterminado del botón de cancelar.

        if (confirm('¿Estás seguro de que quieres cancelar?' + '\n\nCreado por Braulio Ruiz Niñoles')) {
            // Muestra un cuadro de diálogo de confirmación y, si el usuario confirma, ejecuta el siguiente bloque de código.

            window.location.href = '../../index.php';
            // Redirige al usuario a la página 'index.php' en el directorio principal.
        }
    });
});
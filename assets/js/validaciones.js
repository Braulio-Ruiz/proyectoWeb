/* Validaciones para los formularios de categorías y productos */

// Esta función se ejecuta cuando el documento HTML está completamente cargado y listo.
$(document).ready(function () {
    // Validación en tiempo real del formulario
    $("#formCategorias input, #formProductos input").on('keyup blur', function () {
        var $this = $(this);
        if ($this.val().trim() === "") {
            // Añadir clase de error al campo vacío
            $this.addClass('error');
        } else {
            // Eliminar clase de error si el campo no está vacío
            $this.removeClass('error');
        }
    });
    // Validación del formulario de categorías
    // Esta función se ejecuta cuando el formulario con id "formCategorias" se envía.
    $("#formCategorias").submit(function (event) {
        // Evita el comportamiento predeterminado del formulario de enviar datos al servidor.
        event.preventDefault();
        // Obtener los valores de los campos
        // Obtiene el valor del campo con id "nombreCategoria" y elimina los espacios en blanco de ambos extremos.
        var nombreCategoria = $("#nombreCategoria").val().trim();
        // Verificar si los campos están vacíos
        // Crea un array vacío para almacenar los nombres de los campos que están vacíos.
        var errores = [];
        // Si el campo "nombreCategoria" está vacío, añade un mensaje de error al array.
        if (nombreCategoria === "") {
            errores.push("Nombre de la Categoría");
        }
        // Mostrar errores si existen
        // Si hay errores, muestra una alerta con los nombres de los campos vacíos.
        if (errores.length > 0) {
            alert("Completar los siguientes campos: " + errores.join(", ") + ".");
            // Detiene el envío del formulario.
            return false;
        }
        // Si no hay errores, permitir el envío del formulario
        // Si no hay errores, envía el formulario.
        this.submit();
    });
    // Validación del formulario de productos
    // Esta función se ejecuta cuando el formulario con id "formProductos" se envía.
    $("#formProductos").submit(function (event) {
        // Evita el comportamiento predeterminado del formulario de enviar datos al servidor.
        event.preventDefault();
        // Obtener los valores de los campos
        // Obtiene el valor del campo con id "nombreProducto" y elimina los espacios en blanco de ambos extremos.
        var nombreProducto = $("#nombreProducto").val().trim();
        // Obtiene el valor del campo con id "descripcionProducto" y elimina los espacios en blanco de ambos extremos.
        var descripcionProducto = $("#descripcionProducto").val().trim();
        // Obtiene el valor del campo con id "imagenProducto" y elimina los espacios en blanco de ambos extremos.
        var imagenProducto = $("#imagenProducto").val().trim();
        // Obtiene el valor del campo con id "precioProducto" y elimina los espacios en blanco de ambos extremos.
        var precioProducto = $("#precioProducto").val().trim();
        // Obtiene el valor del campo con id "categoriaProducto" y elimina los espacios en blanco de ambos extremos.
        var categoriaProducto = $("#categoriaProducto").val().trim();
        // Verificar si los campos están vacíos
        // Crea un array vacío para almacenar los nombres de los campos que están vacíos.
        var errores = [];
        // Si el campo "nombreProducto" está vacío, añade un mensaje de error al array.
        if (nombreProducto === "") {
            errores.push("Nombre del Producto");
        }
        // Si el campo "descripcionProducto" está vacío, añade un mensaje de error al array.
        if (descripcionProducto === "") {
            errores.push("Descripción del Producto");
        }
        // Si el campo "imagenProducto" está vacío, añade un mensaje de error al array.
        if (imagenProducto === "") {
            errores.push("Imagen del Producto");
        }
        // Si el campo "precioProducto" está vacío, añade un mensaje de error al array.
        if (precioProducto === "") {
            errores.push("Precio del Producto");
        }
        // Si el campo "categoriaProducto" está vacío, añade un mensaje de error al array.
        if (categoriaProducto === "") {
            errores.push("Categoría del Producto");
        }
        // Mostrar errores si existen
        // Si hay errores, muestra una alerta con los nombres de los campos vacíos.
        if (errores.length > 0) {
            alert("Completar los siguientes campos: " + errores.join(", ") + ".");
            // Detiene el envío del formulario.
            return false;
        }
        // Si no hay errores, permitir el envío del formulario
        // Si no hay errores, envía el formulario.
        this.submit();
    });
    // Confirmación al hacer clic en el botón "Cancelar"
    // Esta función se ejecuta cuando se hace clic en un elemento con la clase "btn-cancelar".
    $('.btn-cancelar').on('click', function (event) {
        // Evita el comportamiento predeterminado del botón de cancelar.
        event.preventDefault();
        // Muestra un cuadro de diálogo de confirmación y, si el usuario confirma, ejecuta el siguiente bloque de código.
        if (confirm('¿Estás seguro de que quieres cancelar?')) {
            // Redirige al usuario a la página 'index.php' en el directorio principal.
            window.location.href = '../../index.php';
        }
    });
});
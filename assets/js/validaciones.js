/* Validaciones para los formularios de categorías y productos */
/* Creado por Braulio Ruiz Niñoles */

$(document).ready(function () {
    // Validación del formulario de categorías
    $("#formCategorias").submit(function (event) {
        // Evitar el envío del formulario por defecto
        event.preventDefault();

        // Obtener los valores de los campos
        var nombreCategoria = $("#nombreCategoria").val().trim();

        // Verificar si los campos están vacíos
        var errores = [];
        if (nombreCategoria === "") {
            errores.push("Nombre de la Categoría");
        }

        // Mostrar errores si existen
        if (errores.length > 0) {
            alert("Completar los siguientes campos: " + errores.join(", ") + "." + '\n\nCreado por Braulio Ruiz Niñoles');
            return false;
        }

        // Si no hay errores, permitir el envío del formulario
        this.submit();
    });

    // Validación del formulario de productos
    $("#formProductos").submit(function (event) {
        // Evitar el envío del formulario por defecto
        event.preventDefault();

        // Obtener los valores de los campos
        var nombreProducto = $("#nombreProducto").val().trim();
        var descripcionProducto = $("#descripcionProducto").val().trim();
        var imagenProducto = $("#imagenProducto").val().trim();
        var precioProducto = $("#precioProducto").val().trim();
        var categoriaProducto = $("#categoriaProducto").val().trim();

        // Verificar si los campos están vacíos
        var errores = [];
        if (nombreProducto === "") {
            errores.push("Nombre del Producto");
        }
        if (descripcionProducto === "") {
            errores.push("Descripción del Producto");
        }
        if (imagenProducto === "") {
            errores.push("Imagen del Producto");
        }
        if (precioProducto === "") {
            errores.push("Precio del Producto");
        }
        if (categoriaProducto === "") {
            errores.push("Categoría del Producto");
        }

        // Mostrar errores si existen
        if (errores.length > 0) {
            alert("Completar los siguientes campos: " + errores.join(", ") + "." + '\n\nCreado por Braulio Ruiz Niñoles');
            return false;
        }

        // Si no hay errores, permitir el envío del formulario
        this.submit();
    });
    // Confirmación al hacer clic en el botón "Cancelar"
    $('.btn-cancelar').on('click', function (event) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que quieres cancelar?' + '\n\nCreado por Braulio Ruiz Niñoles')) {
            window.location.href = '../../index.php';
        }
    });
});


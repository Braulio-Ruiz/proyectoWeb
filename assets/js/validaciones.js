// Esta función se ejecuta cuando el documento HTML está completamente cargado y listo.
$(document).ready(function () {
    // Maneja los eventos 'keyup' y 'blur' en los campos de entrada dentro de los formularios especificados
    $("#formCategorias, #formProductos").on('keyup blur', 'input', function () {
        var $this = $(this); // Convierte el campo de entrada actual en un objeto jQuery
        if ($this.val().trim() === "") { // Verifica si el campo está vacío después de eliminar espacios en blanco
            $this.addClass('error'); // Agrega la clase 'error' al campo
        } else {
            $this.removeClass('error'); // Elimina la clase 'error' si el campo no está vacío
        }
    });

    // Maneja el evento 'click' en el botón con clase 'btn-cancelar'
    $('.btn-cancelar').on('click', function (event) {
        event.preventDefault(); // Previene el comportamiento por defecto del botón (enviar una solicitud o seguir un enlace)
        // Muestra un cuadro de confirmación al usuario
        if (confirm('¿Estás seguro de que quieres cancelar?')) {
            // Redirige al usuario a la página principal si confirma la acción
            window.location.href = '../../index.php';
        }
    });

    // Maneja el evento 'click' en los botones de eliminación de categoría
    $('.deleteCat').on('click', function (event) {
        // Previene el comportamiento por defecto (envío del formulario)
        event.preventDefault();
        // Muestra un cuadro de confirmación al usuario antes de eliminar la categoría
        var confirmation = confirm('¿Estás seguro de que deseas eliminar esta categoría? Todos los productos asociados se eliminarán.');
        if (confirmation) {
            // Si el usuario confirma, realiza la eliminación mediante AJAX
            eliminarCategoria($(this).data('id'));  // Pasa el ID de la categoría al realizar la eliminación
        }
    });

    // Maneja el evento 'click' en los botones de eliminación de producto
    $('.deleteProd').on('click', function (event) {
        // Previene el comportamiento por defecto (envío del formulario)
        event.preventDefault();
        // Muestra un cuadro de confirmación al usuario antes de eliminar el producto
        var confirmation = confirm('¿Estás seguro de que deseas eliminar este producto?');
        if (confirmation) {
            // Si el usuario confirma, realiza la eliminación mediante AJAX
            eliminarProducto($(this).data('id')); // Pasa el ID del producto al realizar la eliminación
        }
    });
});

// Función para eliminar una categoría utilizando AJAX
function eliminarCategoria(id) {
    $.ajax({
        url: '../../backend/categorias.php', // Cambia esta ruta por la correcta
        type: 'POST',
        data: { eliminar: true, id: id },  // Envía el ID de la categoría y una bandera de eliminación
        success: function (_response) {
            alert('Categoría eliminada con éxito.');
            location.reload();  // Recarga la página después de la eliminación
        },
        error: function (_xhr, _status, error) {
            alert('Error al eliminar la categoría: ' + error);
        }
    });
}

// Función para eliminar un producto utilizando AJAX
function eliminarProducto(id) {
    $.ajax({
        url: '../../backend/productos.php', // Cambia esta ruta por la correcta
        type: 'POST',
        data: { eliminar: true, id: id },  // Envía el ID del producto y una bandera de eliminación
        success: function (_response) {
            alert('Producto eliminado con éxito.');
            location.reload();  // Recarga la página después de la eliminación
        },
        error: function (_xhr, _status, error) {
            alert('Error al eliminar el producto: ' + error);
        }
    });
}

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
            // Si el usuario confirma, envía el formulario o realiza la solicitud AJAX para eliminar
            var deleteUrl = $(this).data('href'); // Asume que 'data-href' tiene la URL de eliminación
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                success: function (response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            alert('Categoría eliminada correctamente.');
                            location.reload(); // Recarga la página después de eliminar
                        } else {
                            alert('Error al eliminar la categoría: ' + jsonResponse.error);
                        }
                    } catch (e) {
                        alert('Error al procesar la respuesta del servidor.');
                    }
                },
                error: function () {
                    alert('Error en la solicitud de eliminación.');
                }
            });
        }
    });
    // Maneja el evento 'click' en los botones de eliminación de producto
    $('.deleteProd').on('click', function (event) {
        // Previene el comportamiento por defecto (envío del formulario)
        event.preventDefault();
        // Muestra un cuadro de confirmación al usuario antes de eliminar el producto
        var confirmation = confirm('¿Estás seguro de que deseas eliminar este producto?');
        if (confirmation) {
            // Si el usuario confirma, envía el formulario o realiza la solicitud AJAX para eliminar
            var deleteUrl = $(this).data('href'); // Asume que 'data-href' tiene la URL de eliminación
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                success: function (response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            alert('Producto eliminado correctamente.');
                            location.reload(); // Recarga la página después de eliminar
                        } else {
                            alert('Error al eliminar el producto: ' + jsonResponse.error);
                        }
                    } catch (e) {
                        alert('Error al procesar la respuesta del servidor.');
                    }
                },
                error: function () {
                    alert('Error en la solicitud de eliminación.');
                }
            });
        }
    });
});
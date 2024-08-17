/* Validaciones para los formularios de categorías y productos */

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
});

// Función para eliminar una categoría
function eliminarCategoria() {
    // Confirmación antes de proceder
    if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) { }
}

// Función para eliminar un producto
function eliminarProducto() {
    // Confirmación antes de proceder
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) { }
}
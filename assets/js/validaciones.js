/* Validaciones para los formularios de categorías y productos */

// Esta función se ejecuta cuando el documento HTML está completamente cargado y listo.
$(document).ready(function () {
    // Define una función para validar los campos del formulario
    function validarCampos(campos) {
        var errores = []; // Crea un array para almacenar los nombres de los campos con errores
        // Itera sobre cada campo pasado a la función
        campos.each(function () {
            var $this = $(this); // Convierte el elemento actual en un objeto jQuery
            if ($this.val().trim() === "") { // Verifica si el valor del campo está vacío después de eliminar espacios en blanco
                $this.addClass('error'); // Agrega la clase 'error' al campo para indicar un error
                // Agrega el nombre del campo (con formato mejorado) al array de errores
                errores.push(
                    $this.attr('name') // Obtiene el valor del atributo 'name' del campo
                        .replace(/_/g, ' ') // Reemplaza los guiones bajos con espacios
                        .replace(/\b\w/g, l => l.toUpperCase()) // Capitaliza la primera letra de cada palabra
                );
            } else {
                $this.removeClass('error'); // Elimina la clase 'error' si el campo no está vacío
            }
        });
        // Devuelve el array de errores
        return errores;
    }
    // Maneja los eventos 'keyup' y 'blur' en los campos de entrada dentro de los formularios especificados
    $("#formCategorias, #formProductos").on('keyup blur', 'input', function () {
        var $this = $(this); // Convierte el campo de entrada actual en un objeto jQuery
        if ($this.val().trim() === "") { // Verifica si el campo está vacío después de eliminar espacios en blanco
            $this.addClass('error'); // Agrega la clase 'error' al campo
        } else {
            $this.removeClass('error'); // Elimina la clase 'error' si el campo no está vacío
        }
    });
    // Maneja el evento 'submit' del formulario con id 'formCategorias'
    $("#formCategorias").submit(function (event) {
        event.preventDefault(); // Previene el comportamiento por defecto del formulario (enviar la solicitud)
        var errores = validarCampos($("#nombreCategoria")); // Llama a la función de validación para el campo 'nombreCategoria'
        if (errores.length > 0) { // Verifica si hay errores
            alert("Completar los siguientes campos: " + errores.join(", ") + " de la Categoria."); // Muestra una alerta con los campos faltantes
            return false; // Previene el envío del formulario
        }
        this.submit(); // Envía el formulario si no hay errores
    });
    // Maneja el evento 'submit' del formulario con id 'formProductos'
    $("#formProductos").submit(function (event) {
        event.preventDefault(); // Previene el comportamiento por defecto del formulario (enviar la solicitud)
        // Selecciona todos los campos del formulario que deben ser validados
        var campos = $("#nombreProducto, #descripcionProducto, #imagenProducto, #precioProducto");
        var errores = validarCampos(campos); // Llama a la función de validación para los campos seleccionados
        if (errores.length > 0) { // Verifica si hay errores
            alert("Completar los siguientes campos: " + errores.join(", ") + " del Producto."); // Muestra una alerta con los campos faltantes
            return false; // Previene el envío del formulario
        }
        this.submit(); // Envía el formulario si no hay errores
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

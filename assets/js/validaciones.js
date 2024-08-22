$(document).ready(function () {
  // Maneja los eventos 'keyup' y 'blur' en los campos de entrada dentro de los formularios especificados
  $("#formCategorias, #formProductos").on("keyup blur", "input", function () {
    var $this = $(this); // Convierte el campo de entrada actual en un objeto jQuery
    // Verifica si el campo está vacío después de eliminar espacios en blanco
    if ($this.val().trim() === "") {
      // Si el campo está vacío, agrega la clase 'error' para indicar un problema visualmente
      $this.addClass("error");
    } else {
      // Si el campo no está vacío, elimina la clase 'error' para indicar que el campo es válido
      $this.removeClass("error");
    }
  });

  // Maneja el evento 'click' en el botón con clase 'btn-cancelar'
  $(".btn-cancelar").on("click", function (event) {
    // Previene el comportamiento por defecto del botón (enviar una solicitud o seguir un enlace)
    event.preventDefault();
    // Muestra un cuadro de confirmación al usuario para cancelar la acción
    if (confirm("¿Estás seguro de que quieres cancelar?")) {
      // Si el usuario confirma, redirige al usuario a la página principal
      window.location.href = "../../index.php";
    }
  });

  // Maneja el evento 'click' en los botones de eliminación de categoría
  $(".deleteCat").on("click", function (event) {
    // Previene el comportamiento por defecto (envío del formulario)
    event.preventDefault();
    // Muestra un cuadro de confirmación al usuario antes de eliminar la categoría
    var confirmation = confirm(
      "¿Estás seguro de que deseas eliminar esta categoría? Todos los productos asociados se eliminarán."
    );
    if (confirmation) {
      // Si el usuario confirma, realiza una solicitud AJAX para eliminar la categoría
      var deleteUrl = $(this).data("href"); // Obtiene la URL de eliminación desde el atributo 'data-href'
      $.ajax({
        url: deleteUrl, // URL para realizar la eliminación en el servidor
        type: "POST", // Método HTTP para enviar la solicitud
        success: function (response) {
          try {
            // Intenta analizar la respuesta del servidor como JSON
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
              // Si la eliminación es exitosa, muestra un mensaje y recarga la página
              alert("Categoría eliminada correctamente.");
              location.reload(); // Recarga la página para reflejar los cambios
            } else {
              // Si hay un error, muestra el mensaje de error proporcionado por el servidor
              alert("Error al eliminar la categoría: " + jsonResponse.error);
            }
          } catch (e) {
            // Maneja cualquier error que ocurra al procesar la respuesta del servidor
            alert("Error al procesar la respuesta del servidor.");
          }
        },
        error: function () {
          // Muestra un mensaje de error si la solicitud AJAX falla
          alert("Error en la solicitud de eliminación.");
        },
      });
    }
  });

  // Maneja el evento 'click' en los botones de eliminación de producto
  $(".deleteProd").on("click", function (event) {
    // Previene el comportamiento por defecto (envío del formulario)
    event.preventDefault();
    // Muestra un cuadro de confirmación al usuario antes de eliminar el producto
    var confirmation = confirm(
      "¿Estás seguro de que deseas eliminar este producto?"
    );
    if (confirmation) {
      // Si el usuario confirma, realiza una solicitud AJAX para eliminar el producto
      var deleteUrl = $(this).data("href"); // Obtiene la URL de eliminación desde el atributo 'data-href'
      $.ajax({
        url: deleteUrl, // URL para realizar la eliminación en el servidor
        type: "POST", // Método HTTP para enviar la solicitud
        success: function (response) {
          try {
            // Intenta analizar la respuesta del servidor como JSON
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
              // Si la eliminación es exitosa, muestra un mensaje y recarga la página
              alert("Producto eliminado correctamente.");
              location.reload(); // Recarga la página para reflejar los cambios
            } else {
              // Si hay un error, muestra el mensaje de error proporcionado por el servidor
              alert("Error al eliminar el producto: " + jsonResponse.error);
            }
          } catch (e) {
            // Maneja cualquier error que ocurra al procesar la respuesta del servidor
            alert("Error al procesar la respuesta del servidor.");
          }
        },
        error: function () {
          // Muestra un mensaje de error si la solicitud AJAX falla
          alert("Error en la solicitud de eliminación.");
        },
      });
    }
  });
});

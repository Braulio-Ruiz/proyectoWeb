<?php

// Definición de la clase 'Productos' para manejar las operaciones relacionadas con los productos.
class Productos
{
   // Propiedades privadas para almacenar los detalles del producto.
   private $id;                // Identificador único del producto.
   private $nombre;            // Nombre del producto.
   private $imagen;            // Ruta de la imagen del producto.
   private $descripcion;       // Descripción del producto.
   private $precio;            // Precio del producto.
   private $categoria_id;      // Identificador de la categoría a la que pertenece el producto.
   private $db;                // Instancia de la clase 'Database' para manejar las operaciones de base de datos.
   // Constructor de la clase, inicializa la conexión a la base de datos.
   public function __construct()
   {
      try {
         // Crea una nueva instancia de la clase 'Database' y la asigna a la propiedad '$db'.
         $this->db = new Database();
      } catch (Exception $e) {
         // Maneja cualquier error al intentar conectar con la base de datos.
         die("Error al conectar con la base de datos: " . $e->getMessage());
      }
   }
   // Establece el valor de la propiedad '$id' validando que sea un entero.
   public function setId($id)
   {
      // Validar que el ID sea un número entero válido y sanitiza el ID antes de asignarlo para evitar inyecciones.
      $this->id = filter_var($id, FILTER_VALIDATE_INT) ? htmlspecialchars($id, ENT_QUOTES, 'UTF-8') : null;
   }
   // Establece el valor de la propiedad '$nombre' asegurando que esté sanitizado.
   public function setNombre($nombre)
   {
      // Sanitiza el nombre del producto para evitar inyecciones de código.
      $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
   }
   // Establece el valor de la propiedad '$imagen' asegurando que esté sanitizado.
   public function setImagen($imagen)
   {
      // Sanitiza la ruta de la imagen del producto.
      $this->imagen = htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8');
   }
   // Establece el valor de la propiedad '$descripcion' asegurando que esté sanitizado.
   public function setDescripcion($descripcion)
   {
      // Sanitiza la descripción del producto para evitar inyecciones de código.
      $this->descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
   }
   // Establece el valor de la propiedad '$precio', validando que sea un número positivo.
   public function setPrecio($precio)
   {
      // Verifica que el precio sea un número y mayor a 0.
      if (is_numeric($precio) && $precio > 0) {
         $this->precio = $precio;
      } else {
         // Si el precio no es válido, lanza una excepción.
         throw new Exception('Precio inválido.');
      }
   }
   // Establece el valor de la propiedad '$categoria_id', asegurando que esté sanitizado.
   public function setCategoriaId($categoria_id)
   {
      // Sanitiza el ID de la categoría para evitar inyecciones de código.
      $this->categoria_id = htmlspecialchars($categoria_id, ENT_QUOTES, 'UTF-8');
   }
   // Guarda un producto en la base de datos.
   public function guardar()
   {
      // Verifica que todas las propiedades necesarias estén establecidas.
      if (!empty($this->nombre) && !empty($this->precio) && !empty($this->categoria_id)) {
         // Array de datos para guardar o actualizar en la base de datos.
         $data = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'imagen' => $this->imagen,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria_id' => $this->categoria_id,
         ];
         try {
            // Si el ID está definido, actualiza el producto existente.
            if ($this->id) {
               $this->db->update('productos', $data, 'id = ' . $this->id);
            } else {
               // Si no hay ID, inserta un nuevo producto en la base de datos.
               $this->db->insert('productos', $data);
            }
         } catch (Exception $e) {
            // Maneja cualquier error durante la operación en la base de datos.
            die("Error al guardar el producto: " . $e->getMessage());
         }
      } else {
         // Si algún campo necesario no está definido, lanza un error.
         die("Todos los campos del producto deben estar completos.");
      }
   }
   // Elimina un producto de la base de datos utilizando el ID.
   public function eliminar()
   {
      // Verifica que el ID esté definido antes de intentar eliminar el producto.
      if ($this->id) {
         try {
            // Elimina el producto de la base de datos según su ID.
            $this->db->delete('productos', "id = $this->id");
         } catch (Exception $e) {
            // Maneja cualquier error durante la operación de eliminación.
            die("Error al eliminar el producto: " . $e->getMessage());
         }
      } else {
         // Si el ID no está definido, lanza un error.
         die("El ID del producto no está definido.");
      }
   }
   // Obtiene todos los productos de la base de datos junto con el nombre de la categoría.
   public function obtenerTodos()
   {
      // Define una consulta SQL para seleccionar todos los productos y el nombre de la categoría.
      $sql = 'SELECT p.*, c.nombre AS categoria_nombre FROM productos p
               JOIN categorias c ON p.categoria_id = c.id';
      try {
         // Ejecuta la consulta SQL y devuelve los resultados.
         return $this->db->select($sql);
      } catch (Exception $e) {
         // Maneja cualquier error durante la consulta.
         die("Error al obtener los productos: " . $e->getMessage());
      }
   }
   // Busca productos en la base de datos que coincidan con el término de búsqueda.
   public function buscar($term)
   {
      // Sanitiza el término de búsqueda.
      $search = "%{$term}%";
      // Define una consulta SQL para buscar productos por nombre.
      $sql = "SELECT p.*, c.nombre AS categoria_nombre FROM productos p
               JOIN categorias c ON p.categoria_id = c.id
               WHERE p.nombre LIKE ?";
      try {
         // Ejecuta la consulta SQL con el término de búsqueda y devuelve los resultados.
         return $this->db->select($sql, [$search]);
      } catch (Exception $e) {
         // Maneja cualquier error durante la búsqueda.
         die("Error al buscar productos: " . $e->getMessage());
      }
   }
}

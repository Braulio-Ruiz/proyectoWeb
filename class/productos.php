<?php

include 'autoload.php';

// Definición de la clase 'Productos' para manejar las operaciones relacionadas con los productos.
class Productos
{
    // Declaración de propiedades privadas.
    private $id;                // Identificador único del producto.
    private $nombre;            // Nombre del producto.
    private $imagen;            // Ruta de la imagen del producto.
    private $descripcion;       // Descripción del producto.
    private $precio;            // Precio del producto.
    private $categoria_id;      // Identificador de la categoría a la que pertenece el producto.
    private $db;                // Instancia de la clase 'Database' para manejar las operaciones de base de datos.
    // Método constructor de la clase, se ejecuta automáticamente al crear una instancia de la clase.
    public function __construct()
    {
        // Crea una nueva instancia de la clase 'Database' y la asigna a la propiedad '$db'.
        $this->db = new Database();
    }
    // Método para establecer el valor de la propiedad '$id'.
    public function setId($id)
    {
        // Asigna el valor del parámetro '$id' a la propiedad '$id'.
        $this->id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
    }
    // Método para establecer el valor de la propiedad '$nombre'.
    public function setNombre($nombre)
    {
        // Asigna el valor del parámetro '$nombre' a la propiedad '$nombre'.
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    }
    // Método para establecer el valor de la propiedad '$imagen'.
    public function setImagen($imagen)
    {
        // Asigna el valor del parámetro '$imagen' a la propiedad '$imagen'.
        $this->imagen = htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8');
    }
    // Método para establecer el valor de la propiedad '$descripcion'.
    public function setDescripcion($descripcion)
    {
        // Asigna el valor del parámetro '$descripcion' a la propiedad '$descripcion'.
        $this->descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
    }
    public function setPrecio($precio)
    {
        if (is_numeric($precio) && $precio > 0) {
            $this->precio = $precio;
        } else {
            throw new Exception('Precio inválido.');
        }
    }
    // Método para establecer el valor de la propiedad '$categoria_id'.
    public function setCategoriaId($categoria_id)
    {
        // Asigna el valor del parámetro '$categoria_id' a la propiedad '$categoria_id'.
        $this->categoria_id = htmlspecialchars($categoria_id, ENT_QUOTES, 'UTF-8');
    }
    // Método para guardar un producto en la base de datos.
    public function guardar()
    {
        // Método para guardar un producto en la base de datos.
        $data = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'imagen' => $this->imagen,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria_id' => $this->categoria_id,
        ];
        // Llama al método 'insert' de la clase 'Database' para insertar los datos en la tabla 'productos'.
        $this->db->insert('productos', $data);
    }
    // Método para eliminar un producto de la base de datos.
    public function eliminar()
    {
        // Llama al método 'delete' de la clase 'Database' para eliminar el registro de la tabla 'productos' donde el 'id' coincide con el valor de la propiedad '$id'.
        $this->db->delete('productos', "id = $this->id");
    }
    // Método para obtener todos los productos de la base de datos.
    public function obtenerTodos()
    {
        $sql = 'SELECT p.*, c.nombre AS categoria_nombre FROM productos p
                JOIN categorias c ON p.categoria_id = c.id';
        return $this->db->select($sql);
    }
    // Método para buscar en el listado de productos por nombre.
    public function buscar($term)
    {
        $search = "%{$term}%";
        $sql = "SELECT p.*, c.nombre AS categoria_nombre FROM productos p
                JOIN categorias c ON p.categoria_id = c.id
                WHERE p.nombre LIKE ?";
        return $this->db->select($sql, [$search]);
    }
}

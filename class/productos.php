<?php
/* @autor Braulio Ruiz */
// Inicio del script PHP. Comentario para indicar el autor del código.

include 'autoload.php';

class Productos
{
    // Definición de la clase 'Productos' para manejar las operaciones relacionadas con los productos.

    // Declaración de propiedades privadas.
    private $id;                // Identificador único del producto.
    private $nombre;            // Nombre del producto.
    private $imagen;            // Ruta de la imagen del producto.
    private $descripcion;       // Descripción del producto.
    private $precio;            // Precio del producto.
    private $categoria_id;      // Identificador de la categoría a la que pertenece el producto.
    private $db;                // Instancia de la clase 'Database' para manejar las operaciones de base de datos.

    public function __construct()
    {
        // Método constructor de la clase, se ejecuta automáticamente al crear una instancia de la clase.

        $this->db = new Database();
        // Crea una nueva instancia de la clase 'Database' y la asigna a la propiedad '$db'.
    }

    public function setId($id)
    {
        // Método para establecer el valor de la propiedad '$id'.

        $this->id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$id' a la propiedad '$id'.
    }

    public function setNombre($nombre)
    {
        // Método para establecer el valor de la propiedad '$nombre'.

        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$nombre' a la propiedad '$nombre'.
    }

    public function setImagen($imagen)
    {
        // Método para establecer el valor de la propiedad '$imagen'.

        $this->imagen = htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$imagen' a la propiedad '$imagen'.
    }

    public function setDescripcion($descripcion)
    {
        // Método para establecer el valor de la propiedad '$descripcion'.

        $this->descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$descripcion' a la propiedad '$descripcion'.
    }

    public function setPrecio($precio)
    {
        if (is_numeric($precio) && $precio > 0) {
            $this->precio = $precio;
        } else {
            throw new Exception('Precio inválido.');
        }
    }

    public function setCategoriaId($categoria_id)
    {
        // Método para establecer el valor de la propiedad '$categoria_id'.

        $this->categoria_id = htmlspecialchars($categoria_id, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$categoria_id' a la propiedad '$categoria_id'.
    }

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
        // Crea un array asociativo con los valores de las propiedades de la clase.

        $this->db->insert('productos', $data);
        // Llama al método 'insert' de la clase 'Database' para insertar los datos en la tabla 'productos'.
    }

    public function eliminar()
    {
        // Método para eliminar un producto de la base de datos.

        $this->db->delete('productos', "id = $this->id");
        // Llama al método 'delete' de la clase 'Database' para eliminar el registro de la tabla 'productos' donde el 'id' coincide con el valor de la propiedad '$id'.
    }

    public function obtenerTodos()
    {
        // Método para obtener todos los productos de la base de datos.

        return $this->db->select('SELECT * FROM productos');
        // Llama al método 'select' de la clase 'Database' para ejecutar una consulta SQL que obtiene todos los registros de la tabla 'productos' y devuelve el resultado.
    }

    // Método para buscar productos por nombre
    public function buscar($term)
    {
        $search = "%{$term}%";
        $sql = "SELECT * FROM productos WHERE nombre LIKE ?";
        return $this->db->select($sql, [$search]);
    }
}

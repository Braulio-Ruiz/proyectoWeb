<?php
// Definición de la clase 'Categorias'.
class Categorias
{
    // Declaración de propiedades privadas.
    private $id;       // Propiedad para almacenar el ID de la categoría.
    private $nombre;   // Propiedad para almacenar el nombre de la categoría.
    private $db;       // Propiedad para almacenar la instancia de la base de datos.
    // Método constructor de la clase, se ejecuta automáticamente al crear una instancia de la clase.
    public function __construct()
    {
        // Crea una nueva instancia de la clase 'Database' y la asigna a la propiedad '$db'.
        // Esto permite utilizar la base de datos en otros métodos de esta clase.
        $this->db = new Database();
    }
    // Método para establecer el ID de la categoría.
    public function setId($id)
    {
        // Asigna el valor del parámetro '$id' a la propiedad privada '$id' de la clase.
        $this->id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
    }
    // Método para establecer el nombre de la categoría.
    public function setNombre($nombre)
    {
        // Asigna el valor del parámetro '$nombre' a la propiedad privada '$nombre' de la clase.
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    }
    // Método para guardar los datos de la categoría en la base de datos.
    public function guardar()
    {
        // Crea un array '$data' que contiene el nombre de la categoría.
        $data = [
            'nombre' => $this->nombre
        ];
        // Si la propiedad '$id' está establecida (es decir, no es null), entonces se actualiza una categoría existente.
        if ($this->id) {
            // Agrega el ID de la categoría al array '$data'.
            $data['id'] = $this->id;
            // Llama al método 'update' de la clase 'Database' para actualizar la categoría en la base de datos.
            // Pasa el nombre de la tabla ('categorias'), el array de datos ('$data') y la condición ('id = ' . $this->id).
            $this->db->update('categorias', $data, 'id = ' . $this->id);
        }
        // Si la propiedad '$id' no está establecida, entonces se inserta una nueva categoría.
        else {
            // Llama al método 'insert' de la clase 'Database' para insertar la nueva categoría en la base de datos.
            // Pasa el nombre de la tabla ('categorias') y el array de datos ('$data').
            $this->db->insert('categorias', $data);
        }
    }
    // Método para eliminar una categoría de la base de datos.
    public function eliminar()
    {
        // Si la propiedad '$id' está establecida (es decir, no es null), entonces se procede a eliminar la categoría.
        if ($this->id) {
            // Llama al método 'delete' de la clase 'Database' para eliminar la categoría de la base de datos.
            // Pasa el nombre de la tabla ('categorias') y la condición ('id = ' . $this->id).
            $this->db->delete('categorias', 'id = ' . $this->id);
        }
    }
    // Método para obtener todas las categorías de la base de datos.
    public function obtenerTodas()
    {
        // Llama al método 'select' de la clase 'Database' para obtener todas las filas de la tabla 'categorias'.
        // Devuelve el resultado de la consulta.
        return $this->db->select('SELECT * FROM categorias');
    }
    // Método para buscar en el listado de categorías por nombre.
    public function buscar($term)
    {
        $search = "%{$term}%";
        // Realiza la búsqueda en la tabla 'categorias' basándose en el nombre de la categoría.
        $sql = "SELECT * FROM categorias WHERE nombre LIKE ?";
        // Ejecuta la consulta SQL utilizando el método 'select' de la clase 'Database',
        // pasando el término de búsqueda como un parámetro para evitar inyecciones SQL,
        // y devuelve los resultados obtenidos.
        return $this->db->select($sql, [$search]);
    }
}

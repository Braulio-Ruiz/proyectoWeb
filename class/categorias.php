<?php
/* @autor Braulio Ruiz */
// Inicio del script PHP. Comentario para indicar el autor del código.

class Categorias
{
    // Definición de la clase 'Categorias'.

    // Declaración de propiedades privadas.
    private $id;       // Propiedad para almacenar el ID de la categoría.
    private $nombre;   // Propiedad para almacenar el nombre de la categoría.
    private $db;       // Propiedad para almacenar la instancia de la base de datos.

    public function __construct()
    {
        // Método constructor de la clase, se ejecuta automáticamente al crear una instancia de la clase.

        $this->db = new Database();
        // Crea una nueva instancia de la clase 'Database' y la asigna a la propiedad '$db'.
        // Esto permite utilizar la base de datos en otros métodos de esta clase.
    }

    public function setId($id)
    {
        // Método para establecer el ID de la categoría.

        $this->id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$id' a la propiedad privada '$id' de la clase.
    }

    public function setNombre($nombre)
    {
        // Método para establecer el nombre de la categoría.

        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        // Asigna el valor del parámetro '$nombre' a la propiedad privada '$nombre' de la clase.
    }

    public function guardar()
    {
        // Método para guardar los datos de la categoría en la base de datos.

        $data = [
            'nombre' => $this->nombre
        ];
        // Crea un array '$data' que contiene el nombre de la categoría.

        if ($this->id) {
            // Si la propiedad '$id' está establecida (es decir, no es null), entonces se actualiza una categoría existente.

            $data['id'] = $this->id;
            // Agrega el ID de la categoría al array '$data'.

            $this->db->update('categorias', $data, 'id = ' . $this->id);
            // Llama al método 'update' de la clase 'Database' para actualizar la categoría en la base de datos.
            // Pasa el nombre de la tabla ('categorias'), el array de datos ('$data') y la condición ('id = ' . $this->id).
        } else {
            // Si la propiedad '$id' no está establecida, entonces se inserta una nueva categoría.

            $this->db->insert('categorias', $data);
            // Llama al método 'insert' de la clase 'Database' para insertar la nueva categoría en la base de datos.
            // Pasa el nombre de la tabla ('categorias') y el array de datos ('$data').
        }
    }

    public function eliminar()
    {
        // Método para eliminar una categoría de la base de datos.

        if ($this->id) {
            // Si la propiedad '$id' está establecida (es decir, no es null), entonces se procede a eliminar la categoría.

            $this->db->delete('categorias', 'id = ' . $this->id);
            // Llama al método 'delete' de la clase 'Database' para eliminar la categoría de la base de datos.
            // Pasa el nombre de la tabla ('categorias') y la condición ('id = ' . $this->id).
        }
    }

    public function obtenerTodas()
    {
        // Método para obtener todas las categorías de la base de datos.

        return $this->db->select('SELECT * FROM categorias');
        // Llama al método 'select' de la clase 'Database' para obtener todas las filas de la tabla 'categorias'.
        // Devuelve el resultado de la consulta.
    }

    // Método para buscar categorias por nombre
    public function buscar($term)
    {
        $search = "%{$term}%";
        $sql = "SELECT * FROM categorias WHERE nombre LIKE ?";
        return $this->db->select($sql, [$search]);
    }
}

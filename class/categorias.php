<?php

// Definición de la clase 'Categorias' que gestiona las operaciones relacionadas con las categorías.
class Categorias
{
    // Propiedades privadas para el ID, nombre de la categoría y la conexión a la base de datos.
    private $id;
    private $nombre;
    private $db;
    // Constructor de la clase que inicializa la conexión a la base de datos.
    public function __construct()
    {
        try {
            // Crea una nueva instancia de la clase 'Database' para la conexión a la base de datos.
            $this->db = new Database();
        } catch (Exception $e) {
            // Maneja cualquier error al intentar conectar con la base de datos.
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    // Establece el ID de la categoría, validando que sea un entero válido.
    public function setId($id)
    {
        // Validación de que el ID sea un número entero válido.
        if (filter_var($id, FILTER_VALIDATE_INT)) {
            // Sanitiza el ID antes de asignarlo para evitar inyecciones.
            $this->id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
        } else {
            // Si el ID no es válido, establece null para evitar operaciones incorrectas.
            $this->id = null;
        }
    }
    // Establece el nombre de la categoría, asegurando que esté sanitizado.
    public function setNombre($nombre)
    {
        // Sanitiza el nombre de la categoría para evitar inyecciones de código.
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    }
    // Guarda los datos de la categoría en la base de datos, actualizando si ya existe o insertando una nueva.
    public function guardar()
    {
        // Verifica que el nombre esté definido antes de continuar.
        if (!empty($this->nombre)) {
            // Array de datos para guardar o actualizar en la base de datos.
            $data = [
                'nombre' => $this->nombre
            ];
            try {
                // Si el ID está definido, actualiza la categoría existente.
                if ($this->id) {
                    // Actualiza la categoría en la base de datos según su ID.
                    $this->db->update('categorias', $data, 'id = ' . $this->id);
                } else {
                    // Inserta una nueva categoría en la base de datos.
                    $this->db->insert('categorias', $data);
                }
            } catch (Exception $e) {
                // Maneja cualquier error durante la operación en la base de datos.
                die("Error al guardar la categoría: " . $e->getMessage());
            }
        } else {
            // Si el nombre de la categoría no está definido, lanza un error.
            die("El nombre de la categoría no puede estar vacío.");
        }
    }
    // Método para contar los productos asociados a esta categoría
    public function contarProductosAsociados()
    {
        // Consulta SQL para contar los productos asociados a la categoría
        $sql = "SELECT COUNT(*) FROM productos WHERE categoria_id = ?";
        try {
            // Ejecuta la consulta con el ID de la categoría
            return $this->db->select($sql, [$this->id])[0]['COUNT(*)'];
        } catch (Exception $e) {
            // Maneja cualquier error durante la consulta
            die("Error al contar productos asociados: " . $e->getMessage());
        }
    }
    // Elimina una categoría de la base de datos utilizando el ID.
    public function eliminar()
    {
        // Verifica que el ID esté definido antes de intentar eliminar la categoría.
        if ($this->id) {
            try {
                // Verifica si la categoría tiene productos asociados
                if ($this->contarProductosAsociados() > 0) {
                    // Lanza una excepción si hay productos asociados a la categoría
                    die("No se puede eliminar la categoría porque tiene productos asociados.");
                }
                // Elimina la categoría de la base de datos según su ID.
                $this->db->delete('categorias', 'id = ' . $this->id);
            } catch (Exception $e) {
                // Maneja cualquier error durante la operación de eliminación.
                die("Error al eliminar la categoría: " . $e->getMessage());
            }
        } else {
            // Si el ID no está definido, lanza un error.
            die("El ID de la categoría no está definido.");
        }
    }
    // Obtiene todas las categorías de la base de datos y devuelve un array con los resultados.
    public function obtenerTodas()
    {
        try {
            // Selecciona todas las filas de la tabla 'categorias' y las devuelve.
            return $this->db->select('SELECT * FROM categorias');
        } catch (Exception $e) {
            // Maneja cualquier error durante la consulta.
            die("Error al obtener las categorías: " . $e->getMessage());
        }
    }
    // Busca categorías en la base de datos que coincidan con el término proporcionado.
    public function buscar($term)
    {
        // Sanitiza el término de búsqueda para evitar inyecciones SQL.
        $search = "%{$term}%";
        try {
            // Realiza una búsqueda en la base de datos según el nombre de la categoría.
            $sql = "SELECT * FROM categorias WHERE nombre LIKE ?";
            // Ejecuta la consulta SQL con el término de búsqueda y devuelve los resultados.
            return $this->db->select($sql, [$search]);
        } catch (Exception $e) {
            // Maneja cualquier error durante la búsqueda.
            die("Error al buscar categorías: " . $e->getMessage());
        }
    }
}

<?php
/* @autor Braulio Ruiz */
// Inicio del script PHP. Comentario para indicar el autor del código.

class Database
{
    // Definición de la clase 'Database' para manejar las operaciones de la base de datos.

    // Declaración de propiedades privadas.
    private $host = '127.0.0.1';       // Dirección del servidor de base de datos.
    private $db = 'miproyecto';        // Nombre de la base de datos.
    private $user = 'root';            // Nombre de usuario para conectarse a la base de datos.
    private $pass = '';                // Contraseña para conectarse a la base de datos.
    private $charset = 'utf8mb4';      // Conjunto de caracteres a usar en la conexión a la base de datos.
    private $pdo;                      // Variable para almacenar la instancia de PDO (PHP Data Object).

    public function __construct()
    {
        // Método constructor de la clase, se ejecuta automáticamente al crear una instancia de la clase.

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        // Data Source Name (DSN): cadena de conexión que contiene la información para conectarse a la base de datos.

        try {
            // Intentar ejecutar el siguiente bloque de código.

            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            // Crear una nueva instancia de PDO utilizando el DSN, el usuario y la contraseña.

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Configurar PDO para que lance excepciones en caso de errores.
        } catch (PDOException $e) {
            // Capturar cualquier excepción PDO que ocurra durante la conexión.

            throw new PDOException($e->getMessage(), (int)$e->getCode());
            // Relanzar la excepción con el mensaje y el código de error.
        }
    }

    public function insert($table, $data)
    {
        // Método para insertar datos en una tabla específica de la base de datos.

        $keys = implode(", ", array_keys($data));
        // Convertir las claves del array de datos en una cadena separada por comas.

        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        // Crear una cadena de marcadores de posición (placeholders) separados por comas.

        $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
        // Construir la consulta SQL de inserción utilizando la tabla, las claves y los marcadores de posición.

        try {
            $stmt = $this->pdo->prepare($sql);
            // Preparar la consulta SQL para su ejecución.

            $stmt->execute(array_values($data));
            // Ejecutar la consulta con los valores del array de datos.
        } catch (PDOException $e) {
            // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.

            throw new PDOException($e->getMessage(), (int)$e->getCode());
            // Relanzar la excepción con el mensaje y el código de error.
        }
    }

    public function update($table, $data, $where)
    {
        // Método para actualizar datos en una tabla específica de la base de datos.

        $fields = "";
        // Inicializar una cadena vacía para los campos a actualizar.

        foreach ($data as $key => $value) {
            // Recorrer cada par clave-valor del array de datos.

            $fields .= "$key = ?, ";
            // Agregar cada clave con su marcador de posición a la cadena de campos.
        }

        $fields = rtrim($fields, ", ");
        // Eliminar la última coma y espacio de la cadena de campos.

        $sql = "UPDATE $table SET $fields WHERE $where";
        // Construir la consulta SQL de actualización utilizando la tabla, los campos y la condición WHERE.

        try {
            $stmt = $this->pdo->prepare($sql);
            // Preparar la consulta SQL para su ejecución.

            $stmt->execute(array_values($data));
            // Ejecutar la consulta con los valores del array de datos.
        } catch (PDOException $e) {
            // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.

            throw new PDOException($e->getMessage(), (int)$e->getCode());
            // Relanzar la excepción con el mensaje y el código de error.
        }
    }

    public function delete($table, $where)
    {
        // Método para eliminar datos de una tabla específica de la base de datos.

        $sql = "DELETE FROM $table WHERE $where";
        // Construir la consulta SQL de eliminación utilizando la tabla y la condición WHERE.

        try {
            $stmt = $this->pdo->prepare($sql);
            // Preparar la consulta SQL para su ejecución.

            $stmt->execute();
            // Ejecutar la consulta.
        } catch (PDOException $e) {
            // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.

            throw new PDOException($e->getMessage(), (int)$e->getCode());
            // Relanzar la excepción con el mensaje y el código de error.
        }
    }

    public function select($sql, $params = [])
    {
        // Método para seleccionar datos de la base de datos utilizando una consulta SQL.

        try {
            $stmt = $this->pdo->prepare($sql);
            // Preparar la consulta SQL para su ejecución.

            $stmt->execute($params);
            // Ejecutar la consulta con los parámetros proporcionados.

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Obtener todos los resultados de la consulta como un array asociativo y devolverlo.
        } catch (PDOException $e) {
            // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.

            throw new PDOException($e->getMessage(), (int)$e->getCode());
            // Relanzar la excepción con el mensaje y el código de error.
        }
    }
}

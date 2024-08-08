<?php
// Definición de la clase 'Database' para manejar las operaciones de la base de datos.
class Database
{
    // Declaración de propiedades privadas.
    private $host = '127.0.0.1';       // Dirección del servidor de base de datos.
    private $db = 'miproyecto';        // Nombre de la base de datos.
    private $user = 'root';            // Nombre de usuario para conectarse a la base de datos.
    private $pass = '';                // Contraseña para conectarse a la base de datos.
    private $charset = 'utf8mb4';      // Conjunto de caracteres a usar en la conexión a la base de datos.
    private $pdo;                      // Variable para almacenar la instancia de PDO (PHP Data Object).
    // Método constructor de la clase, se ejecuta automáticamente al crear una instancia de la clase.
    public function __construct()
    {
        // Data Source Name (DSN): cadena de conexión que contiene la información para conectarse a la base de datos.
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        // Intentar ejecutar el siguiente bloque de código.
        try {
            // Crear una nueva instancia de PDO utilizando el DSN, el usuario y la contraseña.
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            // Configurar PDO para que lance excepciones en caso de errores.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        // Capturar cualquier excepción PDO que ocurra durante la conexión.
        catch (PDOException $e) {
            // Relanzar la excepción con el mensaje y el código de error.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para insertar datos en una tabla específica de la base de datos.
    public function insert($table, $data)
    {
        // Convertir las claves del array de datos en una cadena separada por comas.
        $keys = implode(", ", array_keys($data));
        // Crear una cadena de marcadores de posición (placeholders) separados por comas.
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        // Construir la consulta SQL de inserción utilizando la tabla, las claves y los marcadores de posición.
        $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
        // Preparar la consulta SQL para su ejecución.
        try {
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta con los valores del array de datos.
            $stmt->execute(array_values($data));
        }
        // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.
        catch (PDOException $e) {
            // Relanzar la excepción con el mensaje y el código de error.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para actualizar datos en una tabla específica de la base de datos.
    public function update($table, $data, $where)
    {
        // Inicializar una cadena vacía para los campos a actualizar.
        $fields = "";
        // Recorrer cada par clave-valor del array de datos.
        foreach ($data as $key => $value) {
            // Agregar cada clave con su marcador de posición a la cadena de campos.
            $fields .= "$key = ?, ";
        }
        // Eliminar la última coma y espacio de la cadena de campos.
        $fields = rtrim($fields, ", ");
        // Construir la consulta SQL de actualización utilizando la tabla, los campos y la condición WHERE.
        $sql = "UPDATE $table SET $fields WHERE $where";
        // Preparar la consulta SQL para su ejecución.
        try {
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta con los valores del array de datos.
            $stmt->execute(array_values($data));
        }
        // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.
        catch (PDOException $e) {
            // Relanzar la excepción con el mensaje y el código de error.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para eliminar datos de una tabla específica de la base de datos.
    public function delete($table, $where)
    {
        // Construir la consulta SQL de eliminación utilizando la tabla y la condición WHERE.
        $sql = "DELETE FROM $table WHERE $where";
        // Preparar la consulta SQL para su ejecución.
        try {
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta.
            $stmt->execute();
        }
        // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.
        catch (PDOException $e) {
            // Relanzar la excepción con el mensaje y el código de error.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para seleccionar datos de la base de datos utilizando una consulta SQL.
    public function select($sql, $params = [])
    {
        // Preparar la consulta SQL para su ejecución.
        try {
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta con los parámetros proporcionados.
            $stmt->execute($params);
            // Obtener todos los resultados de la consulta como un array asociativo y devolverlo.
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Capturar cualquier excepción PDO que ocurra durante la ejecución de la consulta.
        catch (PDOException $e) {
            // Relanzar la excepción con el mensaje y el código de error.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

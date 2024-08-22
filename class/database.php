<?php

// Definición de la clase 'Database' que manejará las operaciones de la base de datos.
class Database
{
    // Declaración de propiedades privadas para la conexión a la base de datos.
    private $host = '127.0.0.1';       // Dirección del servidor de la base de datos (localhost).
    private $db = 'miproyecto';        // Nombre de la base de datos a la que nos conectaremos.
    private $user = 'root';            // Nombre de usuario para acceder a la base de datos.
    private $pass = '';                // Contraseña para el usuario de la base de datos.
    private $charset = 'utf8mb4';      // Conjunto de caracteres a utilizar en la conexión a la base de datos.
    private $pdo;                      // Variable que almacenará la instancia de PDO (PHP Data Object) para interactuar con la base de datos.
    // Constructor de la clase 'Database', se ejecuta automáticamente cuando se crea una instancia de la clase.
    public function __construct()
    {
        // Data Source Name (DSN) que contiene la información de conexión a la base de datos.
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        // Intentamos ejecutar el siguiente bloque de código.
        try {
            // Crear una nueva instancia de PDO usando el DSN, el nombre de usuario y la contraseña.
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            // Configurar PDO para que lance excepciones en caso de errores.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        // Si ocurre un error en la conexión, capturamos la excepción PDOException.
        catch (PDOException $e) {
            // Lanzar la excepción nuevamente con el mensaje de error y el código.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para insertar datos en una tabla específica de la base de datos.
    public function insert($table, $data)
    {
        // Convertir las claves del array asociativo $data en una cadena de texto separada por comas.
        $keys = implode(", ", array_keys($data));
        // Crear una cadena de marcadores de posición (placeholders) para los valores.
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        // Construir la consulta SQL de inserción utilizando las claves y los placeholders.
        $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
        // Intentamos ejecutar el siguiente bloque de código.
        try {
            // Preparar la consulta SQL para su ejecución.
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta, pasando los valores del array $data como parámetros.
            $stmt->execute(array_values($data));
        }
        // Si ocurre un error durante la ejecución de la consulta, capturamos la excepción PDOException.
        catch (PDOException $e) {
            // Lanzar la excepción nuevamente con el mensaje de error y el código.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para actualizar datos en una tabla específica de la base de datos.
    public function update($table, $data, $where)
    {
        // Inicializar una cadena vacía que contendrá los campos a actualizar.
        $fields = "";
        // Recorrer el array $data y construir la cadena de campos con sus respectivos placeholders.
        foreach ($data as $key => $value) {
            // Agregar cada campo y su marcador de posición a la cadena $fields.
            $fields .= "$key = ?, ";
        }
        // Eliminar la última coma y espacio de la cadena $fields.
        $fields = rtrim($fields, ", ");
        // Construir la consulta SQL de actualización.
        $sql = "UPDATE $table SET $fields WHERE $where";
        // Intentamos ejecutar el siguiente bloque de código.
        try {
            // Preparar la consulta SQL para su ejecución.
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta, pasando los valores del array $data como parámetros.
            $stmt->execute(array_values($data));
        }
        // Si ocurre un error durante la ejecución de la consulta, capturamos la excepción PDOException.
        catch (PDOException $e) {
            // Lanzar la excepción nuevamente con el mensaje de error y el código.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para eliminar datos de una tabla específica de la base de datos.
    public function delete($table, $where)
    {
        // Construir la consulta SQL de eliminación utilizando la tabla y la condición WHERE.
        $sql = "DELETE FROM $table WHERE $where";
        // Intentamos ejecutar el siguiente bloque de código.
        try {
            // Preparar la consulta SQL para su ejecución.
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta.
            $stmt->execute();
        }
        // Si ocurre un error durante la ejecución de la consulta, capturamos la excepción PDOException.
        catch (PDOException $e) {
            // Lanzar la excepción nuevamente con el mensaje de error y el código.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    // Método para seleccionar datos de la base de datos utilizando una consulta SQL.
    public function select($sql, $params = [])
    {
        // Intentamos ejecutar el siguiente bloque de código.
        try {
            // Preparar la consulta SQL para su ejecución.
            $stmt = $this->pdo->prepare($sql);
            // Ejecutar la consulta, pasando los parámetros como valores.
            $stmt->execute($params);
            // Obtener todos los resultados de la consulta como un array asociativo.
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Si ocurre un error durante la ejecución de la consulta, capturamos la excepción PDOException.
        catch (PDOException $e) {
            // Lanzar la excepción nuevamente con el mensaje de error y el código.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

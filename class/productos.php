<?php
/* @autor Braulio Ruiz */

class Productos
{
    private $id;
    private $nombre;
    private $imagen;
    private $descripcion;
    private $precio;
    private $categoria_id;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setCategoriaId($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    public function guardar()
    {
        $data = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'imagen' => $this->imagen,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria_id' => $this->categoria_id,
        ];
        $this->db->insert('productos', $data);
    }

    public function eliminar()
    {
        $this->db->delete('productos', "id = $this->id");
    }

    public function obtenerTodos()
    {
        return $this->db->select('SELECT * FROM productos');
    }
}

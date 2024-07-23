<?php
/* @autor Braulio Ruiz */
class Categorias
{
    private $id;
    private $nombre;
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

    public function guardar()
    {
        $data = [
            'nombre' => $this->nombre
        ];

        if ($this->id) {
            $data['id'] = $this->id;
            $this->db->update('categorias', $data, 'id = ' . $this->id);
        } else {
            $this->db->insert('categorias', $data);
        }
    }

    public function eliminar()
    {
        if ($this->id) {
            $this->db->delete('categorias', 'id = ' . $this->id);
        }
    }

    public function obtenerTodas()
    {
        return $this->db->select('SELECT * FROM categorias');
    }
}

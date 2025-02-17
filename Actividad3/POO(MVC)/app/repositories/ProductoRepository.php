<?php
require_once __DIR__.'/../models/Producto.php';

class ProductoRepository{
    private $conn;
    private $table_name = 'productos';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create(Producto $producto)
    {
        $query = "INSERT INTO {$this->table_name} (nombre, descripcion, precio, categoria_id) VALUES (:nombre, :descripcion, :precio, :categoria_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        $stmt->bindParam(':categoria_id', $producto->getCategoriaId());
        return $stmt->execute();
    }

    public function readAll()
    {
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update(Producto $producto)
    {
        $query = "UPDATE {$this->table_name} SET nombre=:nombre, descripcion=:descripcion, precio=:precio, categoria_id=:categoria_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        $stmt->bindParam(':categoria_id', $producto->getCategoriaId());
        $stmt->bindParam(':id', $producto->getId());
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table_name} WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function readOne($id)
    {
        $query = "SELECT * FROM {$this->table_name} WHERE id=:id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }
}
?>
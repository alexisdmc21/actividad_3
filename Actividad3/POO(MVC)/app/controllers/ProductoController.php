<?php
require_once __DIR__ . '/../services/ProductoService.php';
require_once __DIR__ . '/../../config/database.php';

class ProductoController
{
    private $productoService;

    public function __construct()
    {
        $database = new Database();
        $db = $database->conectar();
        $this->productoService = new ProductoService($db);
    }

    public function index()
    {
        $result = $this->productoService->getAll();
        echo json_encode($result);
    }

    public function show($id)
    {
        $result = $this->productoService->getById($id);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Producto no encontrado']);
        }
    }
}
?>
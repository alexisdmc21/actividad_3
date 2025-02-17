<?php
require_once __DIR__ . '/../services/CategoriaService.php';
require_once __DIR__ . '/../../config/database.php';

class CategoriaController
{
    private $categoriaService;

    public function __construct()
    {
        $database = new Database();
        $db = $database->conectar();
        $this->categoriaService = new CategoriaService($db);
    }

    public function index()
    {
        $result = $this->categoriaService->getAll();
        echo json_encode($result);
    }

    public function show($id)
    {
        $result = $this->categoriaService->getById($id);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Categoria no encontrada']);
        }
    }
    public function store()
    {
        $data = json_decode(file_get_contents('php://input'));
        if(!empty($data->nombre) && !empty($data->descripcion)){
            $this->categoriaService->create($data->nombre, $data->descripcion);
            if ($this->categoriaService->create($data->nombre, $data->descripcion)) {
                http_response_code(201);
                echo json_encode(['mensaje' => 'Categoria creada']);
            } else {
                http_response_code(503);
                echo json_encode(['mensaje' => 'Error al crear categoria']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Faltan datos']);
        }
    }
    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'));
        if(!empty($data->id)&&!empty($data->nombre) && !empty($data->descripcion)){
            $this->categoriaService->update($data->id, $data->nombre, $data->descripcion);
            if ($this->categoriaService->update($data->id, $data->nombre, $data->descripcion)) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Categoria actualizada']);
            } else {
                http_response_code(503);
                echo json_encode(['mensaje' => 'Error al actualizar categoria']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Faltan datos']);
        }
    }

    public function destroy($id)
    {
        $data = json_decode(file_get_contents('php://input'));
        if(!empty($data->id)){
            $this->categoriaService->delete($data->id);
            if ($this->categoriaService->delete($data->id)) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Categoria eliminada']);
            } else {
                http_response_code(503);
                echo json_encode(['mensaje' => 'Error al eliminar categoria']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Id no proporcionado']);
        }
    }
}
?>

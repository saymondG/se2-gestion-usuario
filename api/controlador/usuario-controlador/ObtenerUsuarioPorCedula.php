<?php
require_once __DIR__ . '/../../negocios/UsuarioNegocios.php';
require_once __DIR__ . '/../../../entidades/Usuario.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Métodos permitidos
header('Access-Control-Allow-Headers: Content-Type, Authorization');


$putData = file_get_contents("php://input");
$data = json_decode($putData, true);

if (!$data) {
    echo json_encode(["error" => "JSON invalido"]);
    header("HTTP/1.1 400 Bad ");
    exit();
}

$cedula = isset($data['cedula']) ? $data['cedula'] : null;

$usuarioNegocios = new UsuarioNegocios();

$resultado = $usuarioNegocios->obtenerUsuarioPorCedula($cedula);

header('Content-Type: application/json');
if ($resultado != "false") {
    echo json_encode($resultado);
    header("HTTP/1.1 200 ok");
} else {
    echo $resultado;
    header("HTTP/1.1 500 Internal Server Error");
}

exit();
?>
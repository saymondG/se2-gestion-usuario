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
$nombreEntidad = isset($data['nombreEntidad']) ? $data['nombreEntidad'] : null;
$telefono = isset($data['telefono']) ? $data['telefono'] : null;
$correoElectronico = isset($data['correoElectronico']) ? $data['correoElectronico'] : null;
$cedulaRepresentanteLegal = isset($data['cedulaRepresentanteLegal']) ? $data['cedulaRepresentanteLegal'] : null;
$nombreRepresentanteLegal = isset($data['nombreRepresentanteLegal']) ? $data['nombreRepresentanteLegal'] : null;

$usuario = new Usuario($cedula, $nombreEntidad, $telefono, $correoElectronico,
    $cedulaRepresentanteLegal, $nombreRepresentanteLegal);

$usuarioNegocios = new UsuarioNegocios();

$resultado = $usuarioNegocios->actualizarUsuario($usuario);

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
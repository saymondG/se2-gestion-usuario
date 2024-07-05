<?php
require_once __DIR__ . '/../../utilidades/ConexionBaseDatos.php';
require_once __DIR__ . '/../../entidades/Usuario.php';

class UsuarioSG {
    private $db;
    private $url;


    function __construct(){
        $this->url = 'http://localhost/sistema-emisor-dos/servicio-gestion-cuentas/api/controlador/usuario-controlador';
    }

    function registrarUsuario(Usuario $usuario) {
        $data = ['cedula' => $usuario->cedula];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url.'/RegistrarUsuario.php', false, $contexto);
        return json_decode($respuestaSync, true);
    }

    public function actualizarUsuario(Usuario $usuario) {
        $data = ['id' => $usuario->id];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url+'/RegistrarUsuario.php', false, $contexto);

        return json_encode($respuestaSync);
    }



}
?>
<?php
require_once __DIR__ . '/../../utilidades/ConexionBaseDatos.php';
require_once __DIR__ . '/../../entidades/Usuario.php';
require_once __DIR__ . '/UsuarioSG.php';

class UsuarioAD {
    private $db;
    private $usuarioSG;

    function __construct(){
        $this->db = new ConexionBaseDatos();
        $this->usuarioSG = new UsuarioSG();
    }

    function registrarUsuario(Usuario $usuario) {
        $query =
            "INSERT INTO usuario (cedula, nombre_entidad, telefono, correo_electronico, cedula_representante_legal, nombre_representante_legal, fecha_creacion, fecha_modificacion)
                values(
                    '{$usuario->cedula}',
                    '{$usuario->nombreEntidad}',
                    '{$usuario->telefono}',
                    '{$usuario->correoElectronico}',
                    '{$usuario->cedulaRepresentanteLegal}',
                    '{$usuario->nombreRepresentanteLegal}',
                    '".date('d-m-Y')."',
                    '".date('d-m-Y')."'
                )";
        $queryAutoIncrement = "Select cedula from usuario WHERE cedula = '$usuario->cedula'";
        $resultado = $this->db->metodoPost($query, $queryAutoIncrement);

        if(isset($resultado['data'])) {
            $usuario->id = $resultado['data'];
            $resultSync = $this->usuarioSG->registrarUsuario($usuario);
            if (!isset($resultSync['resultado'])) {
                echo "Error: Se produjo un error durante la sincronizacion.";
            }
        }
        return $resultado;
    }

    public function actualizarUsuario(Usuario $usuario) {
        $query = "UPDATE usuario SET ";
        $updateFields = [];

        $updateFields[] = $usuario->nombreEntidad !== null ? "nombre_entidad = '{$usuario->nombreEntidad}'" : null;
        $updateFields[] = $usuario->telefono !== null ? "telefono = '{$usuario->telefono}'" : null;
        $updateFields[] = $usuario->correoElectronico !== null ? "correo_electronico = '{$usuario->correoElectronico}'" : null;
        $updateFields[] = $usuario->cedulaRepresentanteLegal !== null ? "cedula_representante_legal = '{$usuario->cedulaRepresentanteLegal}'" : null;
        $updateFields[] = $usuario->nombreRepresentanteLegal !== null ? "nombre_representante_legal = '{$usuario->nombreRepresentanteLegal}'" : null;
        $updateFields[] = $usuario->fechaModificacion = "fecha_modificacion = '".date('d-m-Y')."'";

        $updateFields = array_filter($updateFields);

        $query .= implode(", ", $updateFields);

        $query .= " WHERE cedula = '{$usuario->cedula}'";
        $resultado= $this->db->metodoPut($query);
        return $resultado;
    }

    public function obtenerUsuarioPorCedula($cedula) {
        $query=
            "SELECT 
                cedula, nombre_entidad, telefono, correo_electronico, cedula_representante_legal, nombre_representante_legal, fecha_creacion, fecha_modificacion 
            FROM usuario WHERE cedula = '$cedula';";
        $resultado= $this->db->metodoGet($query);
        return $resultado;
    }

    public function obtenerTodosLosUsuarios() {
        $query=
            "SELECT 
                cedula, nombre_entidad, telefono, correo_electronico, cedula_representante_legal, nombre_representante_legal, fecha_creacion, fecha_modificacion  
            FROM usuario ";
        $resultado= $this->db->metodoGet($query);
        return $resultado;
    }

}
?>
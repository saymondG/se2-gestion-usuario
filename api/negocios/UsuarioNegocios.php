<?php
require_once __DIR__ . '/../acceso-datos/UsuarioAD.php';
require_once __DIR__ . '/../../entidades/Usuario.php';
require_once __DIR__ . '/../../utilidades/UsuarioReglasDeNegocio.php';

class UsuarioNegocios
{

    private $usuarioAD;
    private $usuarioRN;

     function __construct() {
        $this->usuarioAD = new UsuarioAD();
        $this->usuarioRN = new UsuarioReglasDeNegocio();
    }

    function registrarUsuario(Usuario $usuario) {
         $validarCedula = $this->usuarioRN->validarCedula($usuario->cedula);
         if(!$validarCedula['status']) {
             return $validarCedula['message'];
         }

         $validarNombre = $this->usuarioRN->validarNombre($usuario->nombreEntidad);
         if(!$validarNombre['status']) {
            return $validarNombre['message'];
         }

         $validarTelefono = $this->usuarioRN->validarTelefono($usuario->telefono);
         if(!$validarTelefono['status']) {
             return $validarTelefono['message'];
         }

        $validarCorreo = $this->usuarioRN->validarCorreoElectronico($usuario->correoElectronico);
         if(!$validarCorreo['status']) {
             return $validarCorreo['message'];
         }

        $validarCedulaRepresentante = $this->usuarioRN->validarCedulaRepresentanteLegal($usuario->cedulaRepresentanteLegal);
        if(!$validarCedulaRepresentante['status']) {
            return $validarCedulaRepresentante['message'];
        }

        $validarNombreRepresentante = $this->usuarioRN->validarNombreRepresentante($usuario->nombreRepresentanteLegal);
        if(!$validarNombreRepresentante['status']) {
            return $validarNombreRepresentante['message'];
        }
        return $this->usuarioAD->registrarUsuario($usuario);
    }

    public function actualizarUsuario(Usuario $usuario) {
        return $this->usuarioAD->actualizarUsuario($usuario);
    }

    public function obtenerUsuarioPorCedula($cedula) {
        $validarCedula = $this->usuarioRN->validarCedula($cedula);
        if(!$validarCedula['status']) {
            return $validarCedula['message'];
        }
        return $this->usuarioAD->obtenerUsuarioPorCedula($cedula);
    }

    public function obtenerTodosLosUsuarios() {
        return $this->usuarioAD->obtenerTodosLosUsuarios();
    }

}

?>
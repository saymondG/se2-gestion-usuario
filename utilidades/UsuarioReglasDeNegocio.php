<?php
class UsuarioReglasDeNegocio
{

    function __construct() {
    }

    function validarCedula($data) {
        $regexJuridica = "/^[0-9]{2}-[0-9]{3}-[0-9]{6}$/";
        $regexFisica = "/^[0-9]{2}-[0-9]{4}-[0-9]{4}$/";

        if(is_null($data)) {
            return ['status' => false, 'message' => 'La cedula es nula'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'La cedula esta vacia'];
        }

        if(!preg_match($regexFisica, $data) && !preg_match($regexJuridica, $data)) {
            return ['status' => false, 'message' => 'El formato de la cedula es incorrecto'];
        }
        return ['status' => true];
    }

    function validarNombre($data, $update = false) {

        if(!$update) {
            if(is_null($data)) {
                return ['status' => false, 'message' => 'El nombre es nulo'];
            }
            if(empty($data)) {
                return ['status' => false, 'message' => 'El nombre esta vacio'];
            }
        }

        if(strlen($data) > 70) {
            return ['status' => false, 'message' => 'La longitud debe ser menor igual a setenta caracteres.'];
        }
        return ['status' => true];
    }

    function validarTelefono($data, $update = false) {
        $regexTelefono = "/^[0-9]{4}-[0-9]{4}$/";

        if(!$update) {
            if(is_null($data)) {
                return ['status' => false, 'message' => 'El telefono es nulo'];
            }
            if(empty($data)) {
                return ['status' => false, 'message' => 'El telefono esta vacio'];
            }
        }

        if(!preg_match($regexTelefono, $data)) {
            return ['status' => false, 'message' => 'El formato del telefono es incorrecto'];
        }
        return ['status' => true];
    }

    function validarCorreoElectronico($data, $update = false) {
        $regexCorreo = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";

        if(!$update) {
            if(is_null($data)) {
                return ['status' => false, 'message' => 'El correo es nulo'];
            }
            if(empty($data)) {
                return ['status' => false, 'message' => 'El correo esta vacio'];
            }
        }

        if(!preg_match($regexCorreo, $data)) {
            return ['status' => false, 'message' => 'El formato del correo es incorrecto'];
        }
        return ['status' => true];

        return true;
    }

    function validarCedulaRepresentanteLegal($data, $update = false) {
        $regexCedulaRepresentante = "/^[0-9]{2}-[0-9]{4}-[0-9]{4}$/";

        if(!$update) {
            if(is_null($data)) {
                return ['status' => false, 'message' => 'La cedula del representante es nula'];
            }
            if(empty($data)) {
                return ['status' => false, 'message' => 'La cedula del representante esta vacia'];
            }
        }

        if(!preg_match($regexCedulaRepresentante, $data)) {
            return ['status' => false, 'message' => 'El formato de la cedula del representante es incorrecta'];
        }
        return ['status' => true];
    }

    function validarNombreRepresentante($data, $update = false) {

        if(!$update) {
            if(is_null($data)) {
                return ['status' => false, 'message' => 'El nombre del representante es nulo'];
            }
            if(empty($data)) {
                return ['status' => false, 'message' => 'El nombre del representante esta vacio'];
            }
        }

        if(strlen($data) > 70) {
            return ['status' => false, 'message' => 'La longitud debe ser menor igual a setenta caracteres.'];
        }
        return ['status' => true];
    }


}

?>
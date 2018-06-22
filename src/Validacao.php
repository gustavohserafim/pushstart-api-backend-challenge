<?php

class Validacao{

    public static function validaEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    public static function validaFoto(){
        $tipos_permitidos = ['image/jpeg', 'image/png'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $tipo_detectado = finfo_file($file_info, $_FILES['foto']['tmp_name']);
        if (!in_array($tipo_detectado, $tipos_permitidos)){
            return false;
        }else{
            return true;
        }
        finfo_close($file_info);
    }
};
<?php

namespace App\DB;
use App\Config\responseHTTP;

class sql extends connectionDB{

    //construimos un metodo que me permitira verificar si existe un registro en la BD bajo algunas condiciones
   final public static function verificarRegistro($sql, $condicion, $params){
        try{
            //abrimos la conexion 
            $con = self::getConnection();
            $query = $con->prepare($sql); //preparamos la consulta que viene en el parametro $sql
            $query->execute([
                $condicion=>$params //pasamos la condicion de la consulta y los parametros a tarves de un JSON
            ]);

            //recorre y cunta los datos retornados
            $res = ($query->rowCount() > 0) ? TRUE : FALSE;

            return $res; //retorna la respuesta
        }catch (\PDOException $e){
            //manda un error donde especifica la clase, el metodo y el error correspondiente
            error_log("sql::verificaRegistro -> ".$e);
            //retorna error del server
            die(json_encode(responseHTTP::status500()));
        }
    }
}
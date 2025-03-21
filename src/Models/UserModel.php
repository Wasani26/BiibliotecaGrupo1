<?php
namespace App\Models;
use\DB\connectionDB;
use\DB\sql;
use App\Config\responseHTTP;
use App\Config\Security;

class userModel extends connectionDB{
    private static $Nombre;
    private static $Telefono;
    private static $Correo_electronico;
    private static $Estado;
    private static $Rol;
    private static $Contrasena;
    private static $confirmaContrasena;
    private static $IDToken;
    private static $fecha;

    //constructor

    public function __construct(array $data){
        self::$Nombre  = $data['Nombre'];
        self::$Telefono  =  $data['Telefono'];
        self::$Correo_electronico =  $data['Correo_electronico'];
        self::$Estado  =  $data['Estado'];
        self::$Rol  =  $data['Rol'];
        self::$Contrasena  =  $data['Contrasena'];
        self::$confirmaContrasena  =  $data['confirmaContrasena '];
        self::$IDToken  =  $data['IDToken'];
        self::$fecha  =  $data['fecha '];
    }

 // métodos get
 final public static function getNombre(){return self::$Nombre;}
 final public static function getTelefono(){return self::$Telefono;}
 final public static function getCorreo_electronico(){return self::$Correo_electronico;}
 final public static function getEstado(){return self::$Estado;}
 final public static function getRol(){return self::$Rol;}
 final public static function getContrasena(){return self::$Contrasena;}
 final public static function getconfirmarContrasena(){return self::$confirmaContrasena;}
 final public static function getIDToken(){return self::$IDToken;}
 final public static function getfecha(){return self::$fecha;}

 //métodos set
 final public static function setNombre($Nombre){self::$Nombre = $Nombre;}
 final public static function setTelefono($Telefono){self::$Telefono = $Telefono;}
 final public static function setCorreo_electronico($Correo_electronico){self::$Correo_electronico = $Correo_electronico;}
 final public static function setEstado($Estado){self::$Estado = $Estado;}
 final public static function setRol($Rol){self::$Rol = $Rol;}
 final public static function setContrasena($Contrasena){self::$Contrasena = $Contrasena;}
 final public static function setconfirmaContarsena($confirmaContrasena){self::$confirmaContrasena = $confirmaContrasena;}
 final public static function setIDToken($IDToken){self::$IDToken = $IDToken;}
 final public static function setfecha($fecha){self::$fecha = $fecha;}


 //método que registra el usuario
 final public static function post(){
   //validación para correo 
 }
 
}
<?php
namespace App\Models
use\DB\connectionDB;
use\DB\sql;
use App\Config\responseHTTP;

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

    //métodos get
    //AAAAAAH consultaré al lic porqué nos conviene una forma más que otra de trabaajr con esto
}
<?php
namespace App\Models;
use App\DB\connectionDB;
use App\DB\sql;
use App\Config\responseHTTP;
use App\Config\Security;
use App\Controllers\UserController;


class UserModel extends connectionDB{
    private static $Nombre;
    private static $Telefono;
    private static $Contrasena;
    private static $confirmaContrasena;
    private static $IDToken;
    private static $fecha;
    private static $Correo_electronico;
    private static $Estado;
    private static $Rol_Id_Rol;
   
  

    //constructor

    public function __construct(array $data){
        self::$Nombre  = $data['Nombre'];
        self::$Telefono  =  $data['Telefono'];
        self::$Contrasena  =  $data['Contrasena'];
        self::$confirmaContrasena  =  $data['confirmaContrasena'];
        self::$IDToken = isset($data['IDToken']) ? $data['IDToken'] : null; // Verifica la existencia de la clave
        self::$fecha = isset($data['fecha']) ? $data['fecha'] : null; // Verifica la existencia de la clave
        self::$Correo_electronico =  $data['Correo_electronico'];
        self::$Estado  =  $data['Estado'];
        self::$Rol_Id_Rol  =  $data['Rol_Id_Rol'];
    }

 // métodos get
 final public static function getNombre(){return self::$Nombre;}
 final public static function getTelefono(){return self::$Telefono;}
 final public static function getContrasena(){return self::$Contrasena;}
 final public static function getconfirmaContrasena(){return self::$confirmaContrasena;}
 final public static function getIDToken(){return self::$IDToken;}
 final public static function getfecha(){return self::$fecha;}
 final public static function getCorreo_electronico(){return self::$Correo_electronico;}
 final public static function getEstado(){return self::$Estado;}
 final public static function getRol_Id_Rol(){return self::$Rol_Id_Rol;}

 //métodos set
 final public static function setNombre($Nombre){self::$Nombre = $Nombre;}
 final public static function setTelefono($Telefono){self::$Telefono = $Telefono;}
 final public static function setContrasena($Contrasena){self::$Contrasena = $Contrasena;}
 final public static function setconfirmaContarsena($confirmaContrasena){self::$confirmaContrasena = $confirmaContrasena;}
 final public static function setIDToken($IDToken){self::$IDToken = $IDToken;}
 final public static function setfecha($fecha){self::$fecha = $fecha;}
 final public static function setCorreo_electronico($Correo_electronico){self::$Correo_electronico = $Correo_electronico;}
 final public static function setEstado($Estado){self::$Estado = $Estado;}
 final public static function setRol_Id_Rol($Rol_Id_Rol){self::$Rol_Id_Rol = $Rol_Id_Rol;}


 //método que registra el usuario
 final public static function post(){
   //validación para correo 
   if (sql::verificarRegistro('CALL VerificarCorreoExistente(:Correo_electronico)',':Correo_electronico', self::getCorreo_electronico())){
    return responseHTTP::status400('El correo ya existe en la base de datos');
   }else{
     self::setIDToken(hash('sha512', self::getCorreo_electronico()));
     self::setfecha(date("Y-m-d H:i:s")); //fecha de creación 
   }

   //hash
   //$hashedPassword = Security::createPassword(self::getContrasena());

   try {
    $con = self::getConnection(); //obtener conexión
    $query = "CALL crearUsuario(:Nombre, :Telefono, :Contrasena, :confirmaContrasena, :IDToken, :fecha, :Correo_electronico, :Estado, :Rol_Id_Rol)";
    $stmt = $con->prepare($query);
    $stmt->execute([
      ':Nombre' => self::getNombre(),
      ':Telefono' => self::getTelefono(),
      //':Contrasena' => $hashedPassword,
      ':Contrasena' => password_hash(self::getContrasena(), PASSWORD_DEFAULT),
      ':confirmaContrasena' => self::getconfirmaContrasena(),
      ':IDToken' => self::getIDToken(),
      ':fecha' => self::getfecha(),
      ':Correo_electronico' => self::getCorreo_electronico(),
      ':Estado' => self::getEstado(),
      ':Rol_Id_Rol' => self::getRol_Id_Rol()

    ]);

    if ($stmt->rowCount() > 0){
      return responseHTTP::status200('Se ha registrado el usuario exitosamente');
    }else{
      return responseHTTP::status500('Error al registrar usuario');
    }
   } catch (\PDOException $e){
    error_log('UserModel::post() -> '.$e);
     die(json_encode(responseHTTP::status500("XD")));
   }
 }
 
}
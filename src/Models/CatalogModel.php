<?php

//incompleto//
class CatalogoLibros extends connectionDB {
    private $Nombre;

    //Construtor//
    public function __construct($Nombre) {
        $this->Nombre=$Nombre;
    }

    public function getNombre () { return $this->Nombre;}
    public function setNombre ($Nombre) {return $this->Nombre;}
}

?>
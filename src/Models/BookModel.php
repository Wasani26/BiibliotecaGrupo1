<?php

use App\DB\connectionDB;

class BookModel extends connectionDB{
    //Conexion de propiedas privadas//
    private $Titulo;
    private $autor;
    private $ISBN;
    private $Categoria;
    private $Disponibilidad;
    private $Ubicacion_biblioteca;
    private $Resumen;
    private $Portada;

    public function __construct($Titulo, $autor, $ISBN, $Categoria, $Disponibilidad, $Ubicacion_biblioteca, $Resumen, $Portada){
        $this->Titulo=$Titulo;
        $this->autor=$autor;
        $this->ISBN=$ISBN;
        $this->Categoria=$Categoria;
        $this->Disponibilidad=$Disponibilidad;
        $this->Ubicacion_biblioteca=$Ubicacion_biblioteca;
        $this->Resumen=$Resumen;
        $this->Portada=$Portada;
    }

    //Getters//
    public function getTitulo(){
        return $this->Titulo;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function getISBN(){
        return $this->ISBN;
    }

    public function getCategoria(){
        return $this->Categoria;
    }

    public function getDisponibilidad(){
        return $this->Disponibilidad;
    }

    public function getUbicacionBiblioteca(){
        return $this->Ubicacion_biblioteca;
    }

    public function getResumen(){
        return $this->Resumen;
    }

    public function getPortada(){
        return $this->Portada;
    }

    //Setters//
    public function setTitulo($Titulo){
        return $this->Titulo;
    }

    public function setAutor($autor){
        return $this->autor;
    }

    public function setISBN($ISBN){
        return $this->ISBN;
    }

    public function setCategoria($Categoria){
        return $this->Categoria;
    }

    public function setDisponibilidad($Disponibilidad){
        return $this->Disponibilidad;
    }

    public function setUbicacionBiblioteca($Ubicacion_biblioteca){
        return $this->Ubicacion_biblioteca;
    }

    public function setResumen($Resumen){
        return $this->Resumen;
    }

    public function setPortada($Portada){
        return $this->Portada;
    }

}

?>
<?php

class EvaluacionLibro{
    private $db;

    public function __construct($dataDB){
        $this -> db = $dataDB;
    }

    public function addEvaluacionLibro ($Id_Libros, $Id_Usuarios, $Id_Comentarios){
        $stm = $this -> db -> prepare ();
        
    }

}

?>
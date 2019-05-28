<?php

namespace App\Modules;

//clase madre de conexion a base de datos por inyeccion de dependencias
use App\Primitives\Connection as Connection;

class Rama extends Connection{

    public function qlik(){

        $ramas=$this->database->select("Rama",["Id","Nombre"]);

        return $ramas;
        
    }
    
}

?>
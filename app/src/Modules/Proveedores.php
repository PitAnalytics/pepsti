<?php

namespace App\Modules;

//clase madre de conexion a base de datos por inyeccion de dependencias
use App\Primitives\Connection as Connection;

class Proveedores extends Connection{

    public function qlik(){

        $proveedores = $this->database->select("Proveedores",["Numero","Nombre"]);

        for ($i=0; $i <count($proveedores) ; $i++) { 

            $proveedores[$i]["Numero"]=intval($proveedores[$i]["Numero"]);

        }

        return $proveedores;
        
    }
    
}

?>
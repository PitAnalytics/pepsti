<?php

namespace App\Modules;

//clase madre de conexion a base de datos por inyeccion de dependencias
use App\Primitives\Connection as Connection;
//interface de tabla (metodo index)
use App\Interfaces\TableInterface as TableInterface;

class Pedidos extends Connection implements TableInterface{

    public function qlik(){


        
    }

    public function index(){

        $sql=
        "SELECT Peps.Pep, Pedidos.Pedido, Pedidos.Importe, Pedidos.Descripcion, Proveedores.Nombre FROM Pedidos ".
        "INNER JOIN Peps ON Peps.Id = Pedidos.Id_Pep ".
        "INNER JOIN Proveedores ON Proveedores.Numero = Pedidos.Numero_Proveedor";
        $pedidos = $this->database->query($sql)->fetchAll(2);

        return $pedidos;

    }

    public function search($id,$text){

        if($text==="*"){

            $sql=
            "SELECT Peps.Id, Peps.Pep, Pedidos.Pedido, Pedidos.Importe, Pedidos.Descripcion, Proveedores.Nombre, Proveedores.Numero FROM Pedidos ".
            "INNER JOIN Peps ON Peps.Id = Pedidos.Id_Pep ".
            "INNER JOIN Proveedores ON Proveedores.Numero = Pedidos.Numero_Proveedor ".
            "WHERE Peps.Id = $id ";
            $pedidos = $this->database->query($sql)->fetchAll(2);

            for ($i=0; $i <count($pedidos) ; $i++) { 

                $pedidos[$i]['Id']=intval($pedidos[$i]['Id']);
                $pedidos[$i]['Pedido']=intval($pedidos[$i]['Pedido']);
                $pedidos[$i]['Importe']=floatval($pedidos[$i]['Importe']);

            }
    
            return $pedidos;

        }
        else{

            $sql=
            "SELECT Peps.Id, Peps.Pep, Pedidos.Pedido, Pedidos.Importe, Pedidos.Descripcion, Proveedores.Nombre, Proveedores.Numero FROM Pedidos ".
            "INNER JOIN Peps ON Peps.Id = Pedidos.Id_Pep ".
            "INNER JOIN Proveedores ON Proveedores.Numero = Pedidos.Numero_Proveedor ".
            "WHERE Peps.Id = $id AND ".
            "Pedidos.Descripcion LIKE '%$text%' ";
            $pedidos = $this->database->query($sql)->fetchAll(2);

            for ($i=0; $i <count($pedidos) ; $i++) { 

                $pedidos[$i]['Id']=intval($pedidos[$i]['Id']);
                $pedidos[$i]['Pedido']=intval($pedidos[$i]['Pedido']);
                $pedidos[$i]['Importe']=floatval($pedidos[$i]['Importe']);

            }

            return $pedidos;

        }


    }



}

?>
<?php

namespace App\Modules;

use App\Primitives\Connection as Connection;
use App\Interfaces\TableInterface as TableInterface;

class Peps extends Connection implements TableInterface{

    public function qlik(){

        $peps=$this->database->select("Peps",["Id","Pep","Descripcion","Presupuesto_Inicial","Gasto_Real","Rama"]);

        for ($i=0; $i <count($peps); $i++) { 

            $peps[$i]['Id']=intval($peps[$i]['Id']);
            $peps[$i]['Presupuesto_Inicial']=floatval($peps[$i]['Presupuesto_Inicial']);
            $peps[$i]['Gasto_Real']=floatval($peps[$i]['Gasto_Real']);

        }

        return $peps;

    }

    public function index(){

        $sql = 
        "SELECT `Id`, `Pep`, `Descripcion`, `Presupuesto_Inicial`, `Gasto_Real`, ".
        "(SELECT SUM(Pedidos.Importe) FROM Pedidos WHERE Pedidos.Id_Pep=Peps.Id) AS Gasto_Pedidos, ".
        "(SELECT COUNT(Pedidos.Importe) FROM Pedidos WHERE Pedidos.Id_Pep=Peps.Id) AS Pedidos ".
        "FROM `Peps` ";

        $peps = $this->database->query($sql)->fetchAll(2);

        for ($i=0; $i <count($peps) ; $i++) { 

            $peps[$i]['Id']= intval($peps[$i]['Id']);
            $peps[$i]['Presupuesto_Inicial'] = floatval($peps[$i]['Presupuesto_Inicial']);
            $peps[$i]['Gasto_Real'] = floatval($peps[$i]['Gasto_Real']);

            if($peps[$i]['Gasto_Pedidos']===null){

                $peps[$i]['Gasto_Pedidos'] = 0;

            }
            else{

                $peps[$i]['Gasto_Pedidos'] = floatval($peps[$i]['Gasto_Pedidos']);

            }

            $peps[$i]['Presupuesto_Disponible'] = floatval($peps[$i]['Presupuesto_Inicial'])-(floatval($peps[$i]['Gasto_Real'])+floatval($peps[$i]['Gasto_Pedidos']));
            
        }

        return $peps;

    }

    public function branch($branch){

        if($branch==="*"){

            $sql = 
            "SELECT `Id`, `Pep`, `Descripcion`, `Presupuesto_Inicial`, `Gasto_Real`, ".
            "(SELECT SUM(Pedidos.Importe) FROM Pedidos WHERE Pedidos.Id_Pep=Peps.Id) AS Gasto_Pedidos, ".
            "(SELECT COUNT(Pedidos.Importe) FROM Pedidos WHERE Pedidos.Id_Pep=Peps.Id) AS Pedidos ".
            "FROM `Peps` ";
    
            $peps = $this->database->query($sql)->fetchAll(2);
    
            for ($i=0; $i <count($peps) ; $i++) { 
    
                $peps[$i]['Id']= intval($peps[$i]['Id']);
                $peps[$i]['Presupuesto_Inicial'] = floatval($peps[$i]['Presupuesto_Inicial']);
                $peps[$i]['Gasto_Real'] = floatval($peps[$i]['Gasto_Real']);
    
                if($peps[$i]['Gasto_Pedidos']===null){
    
                    $peps[$i]['Gasto_Pedidos'] = 0;
    
                }
                else{
    
                    $peps[$i]['Gasto_Pedidos'] = floatval($peps[$i]['Gasto_Pedidos']);
    
                }
    
                $peps[$i]['Presupuesto_Disponible'] = floatval($peps[$i]['Presupuesto_Inicial'])-(floatval($peps[$i]['Gasto_Real'])+floatval($peps[$i]['Gasto_Pedidos']));
                
            }
    
            return $peps;

        }
        else{

            $sql = 
            "SELECT `Id`, `Pep`, `Descripcion`, `Presupuesto_Inicial`, `Gasto_Real`, ".
            "(SELECT SUM(Pedidos.Importe) FROM Pedidos WHERE Pedidos.Id_Pep=Peps.Id) AS Gasto_Pedidos, ".
            "(SELECT COUNT(Pedidos.Importe) FROM Pedidos WHERE Pedidos.Id_Pep=Peps.Id) AS Pedidos ".
            "FROM `Peps` ".
            "WHERE Rama = '$branch'";
    
            $peps = $this->database->query($sql)->fetchAll(2);
    
            for ($i=0; $i <count($peps) ; $i++) { 
    
                $peps[$i]['Id']= intval($peps[$i]['Id']);
                $peps[$i]['Presupuesto_Inicial'] = floatval($peps[$i]['Presupuesto_Inicial']);
                $peps[$i]['Gasto_Real'] = floatval($peps[$i]['Gasto_Real']);
    
                if($peps[$i]['Gasto_Pedidos']===null){
    
                    $peps[$i]['Gasto_Pedidos'] = 0;
    
                }
                else{
    
                    $peps[$i]['Gasto_Pedidos'] = floatval($peps[$i]['Gasto_Pedidos']);
    
                }
    
                $peps[$i]['Presupuesto_Disponible'] = floatval($peps[$i]['Presupuesto_Inicial'])-(floatval($peps[$i]['Gasto_Real'])+floatval($peps[$i]['Gasto_Pedidos']));
                
            }
    
            return $peps;
    
        }

    }
    
}

?>

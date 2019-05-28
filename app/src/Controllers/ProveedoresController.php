<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface as Container;

class ProveedoresController extends Controller{

    private $proveedores;

    public function __construct(Container $container){

        $this->container=$container;
        $this->config=$this->container['config'];
        $this->database=$this->container['database']($this->config->database());
        $this->proveedores=$this->container['proveedores']($this->database);
        
    }

    public function qlik($request,$response,$args){

        $proveedores = $this->proveedores->qlik();
        $response1 = $response->withJson($proveedores);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

}

?>
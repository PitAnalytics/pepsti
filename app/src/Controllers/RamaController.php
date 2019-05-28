<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface as Container;

class RamaController extends Controller{

    private $rama;

    public function __construct(Container $container){

        $this->container=$container;
        $this->config=$this->container['config'];
        $this->database=$this->container['database']($this->config->database());
        $this->rama=$this->container['rama']($this->database);
        
    }

    public function qlik($request,$response,$args){

        $ramas = $this->rama->qlik();
        $response1 = $response->withJson($ramas);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

}

?>
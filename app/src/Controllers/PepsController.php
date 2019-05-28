<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface as Container;

class PepsController extends Controller{

    private $peps;

    public function __construct(Container $container){

        $this->container=$container;
        $this->config=$this->container['config'];
        $this->database=$this->container['database']($this->config->database());
        $this->peps=$this->container['peps']($this->database);
        
    }

    public function index($request,$response,$args){

        $peps = $this->peps->index();

        $response1 = $response->withJson($peps);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

    public function branch($request,$response,$args){

        $peps = $this->peps->branch($args['branch']);

        $response1 = $response->withJson($peps);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

    public function qlik($request,$response,$args){

        $pedidos = $this->peps->qlik();
        $response1 = $response->withJson($pedidos);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

}

?>
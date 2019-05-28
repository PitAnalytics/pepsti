<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface as Container;

class PedidosController extends Controller{

    private $pedidos;

    public function __construct(Container $container){

        $this->container=$container;
        $this->config=$this->container['config'];
        $this->database=$this->container['database']($this->config->database());
        $this->pedidos=$this->container['pedidos']($this->database);
        
    }

    public function index($request,$response,$args){

        $pedidos = $this->pedidos->index();
        $response1 = $response->withJson($pedidos);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

    public function search($request,$response,$args){

        $pedidos = $this->pedidos->search($args['id'],$args['text']);
        $response1 = $response->withJson($pedidos);
        $response2 = $response1->withHeader("Access-Control-Allow-Origin","*");

        return $response2;
                
    }

}

?>
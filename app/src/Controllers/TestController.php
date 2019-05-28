<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface as Container;


class TestController extends Controller{

    public function __construct(Container $container){

        $this->container=$container;
        $this->config=$this->container['config'];
        
    }

    public function wellcome($request,$response,$args){

        $response = "WELLCOME";
        return $response;

    }

    public function hello($request,$response,$args){

        $name = $args['name'];
        $response->getBody()->write("Hello, ".$name);
        return $response;
    }

    public function config($request,$response,$args){

        $config=$this->container['config'];

        echo('cool');
        
    }

    public function database($request,$response,$args){

        $config=$this->container['config'];
        $database=$this->container['database']($config->database());
        echo('database works');

    }


}

?>
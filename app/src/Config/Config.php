<?php

namespace App\Config;

class Config{

    private $config;

    public function __construct(){

        $jsonConfig=file_get_contents('../app/src/Config/Config.json');
        $this->config=json_decode($jsonConfig,true);

    }

    public function index(){

        return $this->config;

    }

    public function database(){

        return $this->config['database'];

    }

    public function app(){

        return $this->config['app'];

    }

    public function google($microservice){

        return $this->config['google'][$microservice];

    }
    
}

?>
<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true,'responseChunkSize' => 8096]]);
//
$container=$app->getContainer();

$container['config']=function($container){

    return new App\Config\Config();

};
//
$container['database']=function($container){

    return function($config){

        return new Medoo\Medoo($config);

    };

};
//
$container['peps']=function($container){

    return function($database){

        return new App\Modules\Peps($database);

    };

};
//
$container['pedidos']=function($container){

    return function($database){

        return new App\Modules\Pedidos($database);

    };

};
//
$container['proveedores']=function($container){

    return function($database){

        return new App\Modules\Proveedores($database);

    };

};
//
$container['rama']=function($container){

    return function($database){

        return new App\Modules\Rama($database);

    };

};
?>
<?php
/********************/
/**PSR-7-INTERFACE***/
/********************/
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


/*********************/
/****SLIM-INSTANCE****/
/*********************/
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true,'responseChunkSize' => 8096]]);
require_once '../app/core/container.php';


/******************/
/****ROUTER********/
/******************/
$app->get('/', \App\Controllers\TestController::class.':wellcome');
$app->get('/peps', \App\Controllers\PepsController::class.':index');
$app->get('/peps/branch/{branch}', \App\Controllers\PepsController::class.':branch');
$app->get('/peps/qlik', \App\Controllers\PepsController::class.':qlik');
//////////////////////////////////////////////////////////////////////////////
$app->get('/pedidos', \App\Controllers\PedidosController::class.':index');
$app->get('/pedidos/search/{id}/{text}', \App\Controllers\PedidosController::class.':search');
$app->get('/pedidos/qlik', \App\Controllers\PedidosController::class.':qlik');
//////////////////////////////////////////////////////////////////////////////
$app->get('/rama/qlik', \App\Controllers\RamaController::class.':qlik');
//////////////////////////////////////////////////////////////////////////////
$app->get('/proveedores/qlik', \App\Controllers\ProveedoresController::class.':qlik');
$app->run();


?>
<?php

/**
 * API - Multiplicador de Arrays
 * @author Edgard Bertelli
 * Desenvolvido em 16/3/2022
 */

 error_reporting(E_ALL);
 ini_set('display_errors', 1);

require_once(dirname(__FILE__) . '/inc/API.php');
require_once(dirname(__FILE__) . '/Controller/ArrayController.php');
require_once(dirname(__FILE__) . '/inc/Route.php');

// Inicia a aplicação.
$api = new API();

// Define o método e a URI da requisição.
$api->setMethod($_SERVER['REQUEST_METHOD']);
$api->setEndpoint($_SERVER['REQUEST_URI']);

// Valida o método da requisição.
if (!$api->checkMethod($_SERVER['REQUEST_METHOD'])) {
    $api->error('Este método não é permitido.', 400);
    die;
}

Route::get('home', "ArrayController@multiply");

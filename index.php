<?php

require_once(dirname(__FILE__) . '/inc/Route.php');
require_once(dirname(__FILE__) . '/config/exceptions.php');

/**
 * API - Multiplicador de Arrays
 * @author Edgard Bertelli
 * Desenvolvido em 16/3/2022
 */

// Inicia a aplicação.
$request = new Route();

// Define o método e a URI da requisição.
$request->setMethod($_SERVER['REQUEST_METHOD']);
$request->setEndpoint($_SERVER['REQUEST_URI']);

// Valida o método da requisição.
if (!$request->checkMethod($_SERVER['REQUEST_METHOD'])) {
    $request->error('Este método não é permitido.', 400);
    die;
}

require_once(dirname(__FILE__) . '/routes/api.php');

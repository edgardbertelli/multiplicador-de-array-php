<?php

class Route
{
    private $endpoint;
    /** @var array $data  Dados da requisição. */
    private $data;

    /** @var array $availableMethods  Lista de métodos permitidos pela API. */
    private $availableMethods = ['GET'];


    public function _construct($endpoint)
    {
        $this->data = [];
        $this->endpoint = $endpoint;
    }

    /**
     * Checa a validade do método da requisição.
     * 
     * @param  string  $method  Método da requisição.
     * @return bool
     */
    public function checkMethod(string $method): bool
    {
        return in_array($method, $this->availableMethods);
    }

    /**
     * Define o método de uma requisição.
     * 
     * @param  string  $method  Método da requisição.
     * @return void
     */
    public function setMethod($method)
    {
        $this->data['method'] = $method;
    }

    /**
     * Define o endpoint para a qual a requisição é feita.
     * 
     * @param  string  $endpoint  Endpoint da requisição.
     * @return void
     */
    public function setEndpoint($endpoint)
    {
        $this->data['endpoint'] = $endpoint;
    }

    /**
     * Retorna o endpoint da requisição.
     * 
     * @return string
     */
    public function getEndpoint()
    {
        return $this->data['endpoint'];
    }

    /**
     * Retorna uma mensagem de erro alguns dados da requisição.
     * 
     * @param  string  $message     Mensagem de erro (opcional).
     * @param  int     $statusCode  Código do status.
     * 
     */
    public function error(string $message = '', int $statusCode)
    {
        $this->data['code'] = $statusCode;
        $this->data['message'] = $message;
        return $this->response($statusCode);
    }

    /**
     * Retorna resposta da requisição.
     * 
     * @param  int  $statusCode  Código do status da resposta da requisição.
     */
    public function response(int $statusCode)
    {
        header('Content-Type:application/json');
        http_response_code($statusCode);
        echo json_encode($this->data);
    }

    static public function get(string $routename, $callback)
    {
        $uri = $_SERVER['REQUEST_URI'];

        if ($uri == '/quero/um/array') {
            if (is_string($callback)) {
                if (strpos($callback, '@')) {
                    $exp = explode('@', $callback);
                    $className = $exp[0];
                    $functionName = $exp[1];
                    require_once("app/Controller/$className.php");
                    $class = new $className;
                    return $class->$functionName();
                } else {
                    return $callback;
                }
            } else {
                $callback($callback);
            }
        } else {
            header('Content-Type:application/json');
            http_response_code(404);
            echo json_encode("Rota não encontrada.");
        }
    }
}

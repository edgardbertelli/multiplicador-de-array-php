<?php

class API
{
    /** @var array $data  Dados da requisição. */
    private $data;

    /** @var array $availableMethods  Lista de métodos permitidos pela API. */
    private $availableMethods = ['GET'];

    public function __construct()
    {
        $this->data = [];
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
}

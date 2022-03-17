<?php

class ArrayController
{
    /** @var array  Array de números inteiros randômicos. */
    private array $array;

    /**
     * Inicia um array.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->array = $this->random();
    }
    
    /**
     * Retorna um array com dez elementos de valores numéricos randômicos.
     * 
     * @return array
     */
    private function random(): array
    {
        $randomArray = array();

        for ($i = 1; $i <= 10; $i++) {
            array_push($randomArray, rand(0, 1000));
        }

        return $randomArray;
    }

    /**
     * Multiplica os valores dos elementos de um array pelos seus respectivos índices;
     * 
     * @return array
     */
    public function multiply()
    {
        $multipliedArray = array();

        foreach ($this->array as $key => $value) {
            array_push($multipliedArray,[
                "$key x $value" => $key * $value
            ]);
        }

        return $this->response($multipliedArray);
    }

    /**
     * Retorna array final.
     */
    public function response($data)
    {
        header("Content-Type:application/json");
        http_response_code(200);
        echo json_encode($data);
    }
}
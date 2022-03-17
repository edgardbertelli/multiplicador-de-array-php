<?php

class Route
{
    private $endpoint;

    public function _construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    static public function get(string $routename, $callback)
    {
        if (is_string($callback)) {
            if (strpos($callback, '@')) {
                $exp = explode('@', $callback);
                $className = $exp[0];
                $functionName = $exp[1];
                require_once("Controller/$className.php");
                $class = new $className;
                return $class->$functionName();
            } else {
                return $callback;
            }
        } else {
            $callback($callback);
        }
    }
}

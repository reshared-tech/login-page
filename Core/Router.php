<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function route($uri, $method)
    {
        foreach($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                dd(123);
                [$class, $methodOfObj] = $route['controller'];
                dd($class, $methodOfObj);
                if (class_exists($class)) {
                    $obj = new $class();
                    if (method_exists($obj, $methodOfObj)) {
                        call_user_func_array($obj, $methodOfObj);
                    }
                }
            }
        }

        abort();
    }

    protected function add($uri, $controller, $method) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => strtoupper($method),
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');
    }
 
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }
}

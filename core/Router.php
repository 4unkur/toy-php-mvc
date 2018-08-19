<?php

namespace App\Core;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * 
     * return Router
     */
    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function dispatch($uri, $requestType)
    {
        if (empty($this->routes[$requestType][$uri])) {
            throw new \Exception('No route defined for this URI');
        }

        return $this->callAction(...explode('@', $this->routes[$requestType][$uri]));
    }

    protected function callAction($controller, $action)
    {
        $controller = "App\\Controllers\\$controller";
        $controller = new $controller;

        if (method_exists($controller, $action)) {
            return $controller->$action();
        }

        throw new \Exception("Controller $controller has no action $action");
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }
}
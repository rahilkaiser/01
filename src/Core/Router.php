<?php

namespace Blog\Core;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch($uri, $method)
    {
        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            echo "404 - Not Found";
            return;
        }

        call_user_func($callback);
    }
}
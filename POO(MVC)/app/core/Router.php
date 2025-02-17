<?php
class Router
{
    private $routes = [];

    public function add($method, $route, $callback)
    {
        $this->routes[$method] = [
            'method' => strtoupper($method),
            'route' => $route,
            'callback' => $callback
        ];
    }

    public function dispatch($method, $uri)
    {
        foreach ($this->routes as $route) {
            if (
                $route['method'] === strtoupper($method)
                && preg_match($this->convertRoute($route['route']), $uri, $params)
            ) {
                array_shift($params);
                return call_user_func_array($route['callback'], $params);
            }
        }
    }

    public function convertRoute($route)
    {
        return "#^" . preg_replace('/\\\:[a-zA-Z0-9_]+/', '([a-zA-Z0-9_-]+)', preg_quote($route)) . "$#";
    }
}

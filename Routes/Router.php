<?php

namespace Routes;

use Classes\Request;
use Classes\DatabaseHandler;
use Controllers\HomeController;

class Router
{
    private $request;
    private $methods = ["GET", "POST"];

    function __construct()
    {
        $this->request = new Request();
        $this->con = new DatabaseHandler();
        $this->home = new HomeController();
    }

    public function __call($name, $arguments)
    {
        list($route, $method) = $arguments;
        $this->route = $arguments;
        if (!in_array(strtoupper($name), $this->methods)) return;
        $this->{strtolower($name)}[$this->getRoute($route)] = $method;
    }

    private function getRoute($path)
    {
        $result = rtrim($path, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    function isProduct($route)
    {
        $sku = substr($route, 1);
        $product = $this->con->query("SELECT name, sku FROM products WHERE active = 1 AND sku = ?", [$sku])[0];
        if ($product) return true;
        else return false;
    }

    function __destruct()
    {
        $method = $this->{strtolower($this->request->getMethod())};
        $route = $this->getRoute($this->request->getURL());
        if (!array_key_exists($route, $method)) {
            if ($this->isProduct($route)) {
                $sku = substr($route, 1);
                $this->home->viewProduct($this->request, $sku);
                return;
            }
            $this->request->respondWithStatusCode(404, 'Pagina niet gevonden');
            return;
        }
        $function = $method[$route];
        call_user_func($function, new Request());
    }
}
<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routePath = ROOT . '/config/routes.php';
        $this->routes = include($routePath);
    }

    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    function run()
    {
        try {
            $uri = $this->getUri();
            foreach ($this->routes as $uriPattern => $path) {
                if (preg_match("~$uriPattern~", $uri)) {
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                    $segments = explode('/', $internalRoute);
                    $controllerName = ucfirst(array_shift($segments) . 'Controller');
                    $actionName = 'action' . ucfirst(array_shift($segments));
                    $parameters = $segments;
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }
                    $controllerObject = new $controllerName;
                    call_user_func_array([$controllerObject, $actionName], $parameters);
                    exit();
                }
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        include ROOT . '/404.html';
    }
}

?>
<?php
class Application 
{   
    private $path;
    private $parameters;
    private $controller;
    private $admin;
    
    public function __construct() 
    {
        $this->admin = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : false;
    }
    
    public function run()
    {
        $this->route();
        $this->action();
    }

    protected function route()
    {
        $routes = include(ROOT . "/config/routes.php");
        $uri = trim($_SERVER["REQUEST_URI"], "/");
        $path = "home/page404";
        foreach($routes as $key => $route) {
            if(preg_match("~^$key$~", $uri)) {
                $path = preg_replace("*$key*", $route, $uri);
                break;
            }
        }
        $this->path = $path;
    }
    
    protected function action() 
    {        
        if (!$this->admin && $this->path != 'home/login') {
            header('Location: /login');
        }
        $parts = [];
        $parts = explode("/", $this->path);
        $controllerID = array_shift($parts);
        $actionID = array_shift($parts);
        $controllerClass = ucfirst($controllerID) . "Controller";
        $action = 'action' . ucfirst($actionID);
        $this->parameters = $parts;
        $this->controller = new $controllerClass($controllerID, $actionID, $this->admin);
        $this->controller->$action($this->parameters);
    }
    
}

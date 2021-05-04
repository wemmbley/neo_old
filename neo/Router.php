<?php

/**
 * Class Router
 */
class Router
{
    /**
     * @var object Neo
     */
    private $neo;

    /**
     * Router constructor.
     * @param Neo $neo
     */
    public function __construct(Neo $neo)
    {
        $this->neo = $neo;

        [, $controllerName] = explode('/', $_SERVER['REQUEST_URI']);

        if($controllerName === '') {
            $controllerName = 'Home';
        }

        $controllerName = ucfirst($controllerName) . 'Controller';

        $controllerPath = ABSPATH . 'neo' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';

        if(file_exists($controllerPath)) {
            require_once $controllerPath;

            if(class_exists($controllerName)) {
                (new $controllerName($this->neo));
            }
        }
    }
}
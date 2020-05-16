<?php

namespace Dispatch;

use http\Exception\RuntimeException;
use Routing\DefaultRoute;
use Routing\Route;
use Routing\RoutingException;

final class DefaultDispatcher implements IDispatcher {
    private static object $instance;

    private $matched;

    private function __construct() {}

    private function __clone() {}

    public function getInstance(): object {
        if(!isset(self::$instance)) {
            self::$instance = new DefaultDispatcher();
        }
        return self::$instance;
    }

    public function getMatchedRoute() {
        return $this->matched;
    }

    public function dispatch(){

        $request = $_SERVER['REQUEST_URI'];

        // Ignore everything after ? for the route
        if(($pos = strpos($request, '?')) !== false) {
            $request = substr($request, 0, $pos);
        }

        // Routes iteration
        foreach (Route::get() as $route) {
            if($route->match($request)) {
                $this->matched = $route;
                break;
            }
        }

        if(!isset($this->matched)) {
            throw new RoutingException("None of the routes matched " . "\"" . $request . "\"");
        }

        $controller = "\\Controller\\" . ucfirst($this->matched->getParam("controller"));
        $action = $this->matched->getParam("action");

        if(!class_exists($controller)){
            throw new RoutingException("Non existing class" . "\"" . $controller . "\"");
        }

        if(!is_callable([$controller, $action])) {
            throw new \Exception("Action ".$action." not found in controller ".$controller);
        }

        $ctrlInstance = new $controller();
        $ctrlInstance->$action();
    }
}

<?php

namespace App\Services;

class Router
{
    private $router;
    private $match;

    public function __construct()
    {

        $this->router = new \AltoRouter();
    }
    public function getMap($url, $target, $name = null)
    {

        $this->router->map('GET|POST', $url, $target, $name);
        return $this;
    }

    public function match()
    {
        $this->match = $this->router->match();
        if ($this->match == false) {
            return "error";
        }
        if (strpos($this->match['target'], '@') !== false) {

            return "controller";
        }
        if (strpos($this->match['target'], '/') !== false) {

            return "view";
        }
        if (strpos($this->match['target'], '#') !== false) {

            return "file";
        }
    }
    public function run($viewpath)
    {
        //dump(strpos($match['target'], '@'));die();
        //check if @ exist in the target


        if ($this->match() === "controller") {
            list($controller, $action) = explode('@', $this->match['target']);
            $objetCtr = "App\\Controllers\\{$controller}";
            $controller = new $objetCtr();
            if (is_callable(array($controller, $action))) {
                return call_user_func_array(array($controller, $action), array($this->match['params']));
            }
        }
        if ($this->match() === "view") {
            $targetView = $this->match['target'];
            require $viewpath . DIRECTORY_SEPARATOR . $targetView . ".php";
            return $this;
        }
    }
    public function runFile($viewpath)
    {

        //check if @ exist in the target


        if ($this->match() === "file") {
            list($controller, $action) = explode('#', $this->match['target']);
            $objetCtr = "App\\Controllers\\{$controller}";
            $controller = new $objetCtr();
            if (is_callable(array($controller, $action))) {
                return call_user_func_array(array($controller, $action), array($this->match['params']));
            }
        }
    }
}

            // if ($method=="get"){
            // $this->viewpathGet=$viewpath;
            // $view=$match['target'];
            // require $this->viewpathGet.DIRECTORY_SEPARATOR.$view.".php";
            // return $this;
            // }
            // if ($method=="post"){
            //     $this->viewpathPost=$viewpath;

            //     $view=$match['target'];
            //     require $this->viewpathPost.DIRECTORY_SEPARATOR.$view.".php";
            // return $this;

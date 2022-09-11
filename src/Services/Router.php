<?php

namespace App\Services;

class Router
{
    private $router;

    public function __construct()
    {

        $this->router = new \AltoRouter();
    }
    public function getMap($url, $target, $name = null)
    {
        $this->router->map('GET|POST', $url, $target, $name);
        return $this;
    }


    public function run($viewpath)
    {
        $match = $this->router->match();
        //dump(strpos($match['target'], '@'));die();
        //check if @ exist in the target
       
        if ($match == false) {
            return require $viewpath . DIRECTORY_SEPARATOR . "errors/404.php";
        }
        if (strpos($match['target'], '@') !== false) {
            list($controller, $action) = explode('@', $match['target']);
            $objetCtr = "App\\Controllers\\{$controller}";
            $controller = new $objetCtr();
            if (is_callable(array($controller, $action))) {
                return call_user_func_array(array($controller, $action), array($match['params']));
            }
        }
        $target = $match['target'];
        require $viewpath . DIRECTORY_SEPARATOR . $target . ".php";
        return $this;
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

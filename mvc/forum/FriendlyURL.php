<?php

define("NOT_FOUND_CONTROLLER", "NotFound");
define("DEFAULT_CONTROLLER", "Home");
define("DEFAULT_ACTION", "index");

class FriendlyURL
{
    public function __construct()
    {}

    public function run()
    {
        $controller = $this->getController();
        $action = $this->getAction();
        $params = $this->getParams();
        $res = true;

        $file = ROOT ."app/src/mvc/controller/" .$controller .".php";
        // echo $file ."<br>";

        if (file_exists($file)) {
            // echo "File Exists";

            // $controller = "\App\Controller\\" .$controller;
            // $controller = "\\App\\Controller\\" .$controller;
            // $controller = __NAMESPACE__ ."\\" .$controller;

            $obj = new $controller();
            if (method_exists($obj, $action)) $obj->$action();
            else $res = false;
        } else {
            $res = false;
            echo "Controller \"" .$controller ."\" doesn't exist in FriendlyURL.php";
        }

        if (! $res) {
            $controller = NOT_FOUND_CONTROLLER;
            $action = DEFAULT_ACTION;

            $obj = new $controller;
            $obj->$action();
        }
        die;
    }

    private function getController()
    {
        $cont = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";
        // var_dump($url);

        if ($url !== "/") {
            $url = explode("/", $url);
            array_shift($url);
            // var_dump($url);

            // $cont = ucfirst($url[0]);
            $cont = (isset($url[0])) ? $url[0] : $cont;
            $index = strpos($cont, ".");
            $cont = ($index != "") ? substr($cont, 0, $index) : $cont;

            // TODO:
            // $index = strpos($url[0], ".");
            // $cont .= (isset($index) && $index == strlen($cont) -1) ? "php" : "";
            // $cont .= (! strpos($url[0], ".")) ? ".php" : "";
        }
        // echo "<br> Controller: " .$cont ."<br>";
        return (! empty($cont)) ? (($cont == "index") ? DEFAULT_CONTROLLER : ucfirst($cont)) : DEFAULT_CONTROLLER;
    }

    private function getAction()
    {
        $action = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";
        // var_dump($url);

        if ($url !== "/") {
            $url = explode("/", $url);
            array_shift($url);
            array_shift($url);
            // var_dump($url);

            $action = (isset($url[0])) ? $url[0] : $action;
        }
        // echo "<br> Controller: " .$action ."<br>";
        return (! empty($action)) ? (($action == "index") ? DEFAULT_ACTION : $action) : DEFAULT_ACTION;
    }

    private function getParams()
    {
        $params = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";
        // var_dump($url);

        if ($url !== "/") {
            $url = explode("/", $url);
            array_shift($url);
            array_shift($url);
            array_shift($url);
            // var_dump($url);

            $params = (isset($url[0])) ? $url[0] : $params;
        }
        // echo "<br> Controller: " .$params ."<br>";
        return $params;
    }
}
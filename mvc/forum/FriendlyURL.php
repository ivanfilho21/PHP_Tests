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
        $cont = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";
        // var_dump($url);

        $url = $this->checkRouters($url);
        // echo $url ."<br>";
        
        $controller = $this->getController($url);
        $action = $this->getAction($url);
        $params = $this->getParams($url);
        // echo $params; die;
        $res = true;

        /*echo "Controller: " .$controller ."<br>";
        echo "Action: " .$action ."<br>";
        echo "Params: " .$params ."<br>";*/

        $file = ROOT ."app/src/mvc/controller/" .$controller .".php";
        // echo $file ."<br>";

        if (file_exists($file)) {
            // echo "File Exists";

            // $controller = "\App\Controller\\" .$controller;
            // $controller = "\\App\\Controller\\" .$controller;
            // $controller = __NAMESPACE__ ."\\" .$controller;

            $obj = new $controller();
            if (method_exists($obj, $action)) {
                if (is_callable(array($obj, $action))) {
                    call_user_func_array(array($obj, $action), $params);
                }
                #$obj->$action($params);
            }
            else $res = false;
        } else {
            $res = false;
            echo "Controller \"" .$controller ."\" doesn't exist in FriendlyURL.php";
        }

        if (! $res) {
            $controller = NOT_FOUND_CONTROLLER;
            $action = DEFAULT_ACTION;

            $obj = new $controller;
            if (is_callable(array($obj, $action))) {
                call_user_func_array(array($obj, $action), $params);
            }
            #$obj->$action($params);
        }
        die;
    }

    private function checkRouters($url)
    {
        global $routers;

        foreach ($routers as $key => $newUrl) {
            $regPart = "(\{[a-z0-9]{1,}\})";
            # Identify the arguments and replace them by regex
            $pattern = preg_replace($regPart, "([a-z0-9-]{1,})", $key);

            // echo "Pattern: " .$pattern ."<br>Url: " .$url; die;

            # Check if URL matches pattern
            if (preg_match("#^(" .$pattern .")*$#i", $url, $matches) === 1) {
                array_shift($matches);
                array_shift($matches);

                // var_dump($matches); die;

                # Get the arguments (id, etc)
                if (preg_match_all($regPart, $key, $m)) {
                    $m = preg_replace("(\{|\})", "", $m[0]);
                    // var_dump($m); die;
                }

                # Associate the items with their values
                $arg = array();
                foreach ($matches as $key => $match) {
                    $arg[$m[$key]] = $match;
                }

                // var_dump($arg);

                # Creates the new URL
                foreach ($arg as $key => $a) {
                    $key = ":" .$key;
                    $newUrl = str_replace($key, $a, $newUrl);
                }

                $url = $newUrl;
                break;
            }
        }
        return $url;
    }

    private function getController($url)
    {
        $cont = "";
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
        // return (! empty($cont)) ? (($cont == "index") ? DEFAULT_CONTROLLER : ucfirst($cont)) : DEFAULT_CONTROLLER;
        // return (! empty($cont)) ? ucfirst($cont) : DEFAULT_CONTROLLER;
        return ucfirst($cont);
    }

    private function getAction($url)
    {
        $action = "";

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

    private function getParams($url)
    {
        $params = "";

        if ($url !== "/") {
            $url = explode("/", $url);
            array_shift($url);
            array_shift($url);
            array_shift($url);
            // var_dump($url);

            // $params = implode("/", $url);
            $params = $url;
        }
        // echo "<br> Controller: " .$params ."<br>";
        return $params;
    }
}
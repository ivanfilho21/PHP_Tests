<?php

class FriendlyURL
{
    public function __construct()
    {}

    public function run()
    {
        var_dump($_GET); echo "<br>";

        $controller = $this->getController();
        // $action = $this->getAction();
        $params = $this->getParams();

        echo $controller;

        // TODO: new controller...
    }

    private function getController()
    {
        $cont = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";

        if ($url !== "/") {
            $url = explode("/", $url);
            array_shift($url);
            // var_dump($url);

            $cont = ucfirst($url[0]);
            // TODO:
            // $index = strpos($url[0], ".");
            // $cont .= (isset($index) && $index == strlen($cont) -1) ? "php" : "";
            // $cont .= (! strpos($url[0], ".")) ? ".php" : "";
        }
        return $cont;
    }

    private function getParams()
    {
        /*$params = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";

        if ($url !== "/") {
            $url = explode("/", $url);

            // var_dump($url);

            array_shift($url);

            $page = $url[0];
            $page .= (! strpos($url[0], ".php")) ? ".php" : "";
        }
        return $page;*/
    }

    private function loadPage()
    {
        #
        require TEMPLATES .$this->template ."/" .$this->template .".php";
        require TEMPLATES ."bottom.php";
    }
}
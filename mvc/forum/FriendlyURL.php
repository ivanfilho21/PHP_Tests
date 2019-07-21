<?php

class FriendlyURL
{
    private $template = "";
    private $title = "";

    public function __construct()
    {
        $this->template = "default";
    }

    public function run()
    {
        var_dump($_GET); echo "<br>";

        $page = $this->getPage();
        unset($_GET["url"]);
        $params = $this->getParams();

        echo "<br>Page: " .$page;

        // header("location: " .REL_PAGES .$page);

        $this->loadPage();
    }

    private function getPage()
    {
        $page = "";
        $url = "/";
        $url .= (! empty($_GET["url"])) ? $_GET["url"] : "";

        if ($url !== "/") {
            $url = explode("/", $url);
            array_shift($url);
            // var_dump($url);

            $page = $url[0];
            // TODO:
            // $index = strpos($url[0], ".");
            // $page .= (isset($index) && $index == strlen($page) -1) ? "php" : "";
            // $page .= (! strpos($url[0], ".")) ? ".php" : "";
        }
        return $page;
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
<?php

namespace App\Controller;

abstract class Controller
{
    protected $controllerName = "";
    protected $title = "";
    protected $template = "default";
    protected $styles = array();
    protected $scripts = array();

    public function __construct($name = "")
    {
        $this->controllerName = (! empty($name)) ? strtolower($name) ."/" : "";

        global $user;
        $this->user = $user;
    }

    protected function loadView($view)
    {

        require TEMPLATE .$this->template ."/" .$this->template .".php";
    }

    private function requireView($view)
    {
        $file = VIEW .$this->controllerName .$view;
        // echo $file;
        
        if (file_exists($file .".php")) require $file .".php";
        elseif (file_exists($file .".html")) require $file .".html";
        else {
            echo "View doesn't exist!!";
        }
    }

    public abstract function index();
}
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

        global $dba, $auth;
        $this->dba = $dba;
        $this->auth = $auth;
        $this->user = $auth->getLoggedUser();
    }

    protected function loadView($view, $data = array())
    {
        if (! empty($data)) extract($data);
        require TEMPLATE .$this->template ."/" .$this->template .".php";
    }

    private function requireView($view, $data = array())
    {
        if (! empty($data)) extract($data);
        
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
<?php

namespace App\Controller;

abstract class Controller
{
    protected $controllerName = "";
    protected $title = "";
    protected $template = "default";
    protected $pages = array();
    protected $styles = array();
    protected $scripts = array();

    public function __construct($name = "")
    {
        $this->controllerName = (! empty($name)) ? strtolower($name) ."/" : "";

        global $dba, $auth, $date;
        $this->dba = $dba;
        $this->auth = $auth;
        $this->date = $date;
        $this->user = $auth->getLoggedUser();
    }

    protected function loadView($view, $data = array())
    {
        if (! empty($data)) extract($data);
        require TEMPLATE .$this->template ."/" .$this->template .".php";
    }

    protected function checkUserLogged(bool $value = true)
    {
        if (empty($this->user) === $value) {
            redirect("home");
        }
    }

    protected function requireView($view, $data = array(), $fromRoot = false)
    {
        if (! empty($data)) extract($data);
        
        $file = VIEW .(! $fromRoot ? "pages/" .$this->controllerName : "") .$view;
        // echo $file;
        
        if (file_exists($file .".php")) require $file .".php";
        elseif (file_exists($file .".html")) require $file .".html";
        else {
            echo "View doesn't exist!!";
        }
    }

    public abstract function index();
}
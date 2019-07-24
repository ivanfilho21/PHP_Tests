<?php

namespace App\Controller;

abstract class Controller
{
    protected $title = "";
    protected $template = "default";
    protected $styles = array();
    protected $scripts = array();

    public function __construct()
    {}

    protected function loadView($view)
    {
        require TEMPLATE .$this->template ."/" .$this->template .".php";
    }

    private function requireView($view)
    {
        require VIEW .$view .".php";
    }

    public abstract function index();
}
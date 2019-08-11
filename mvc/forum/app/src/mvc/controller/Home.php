<?php

use \App\Controller\Controller;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct("Home");
    }

    public function index()
    {
        $this->title = "Home Page";
        $this->loadView("home");

        echo (! empty($this->user)) ? "Bem vindo, " .$this->user->getUsername() : "";
    }

    public function dashboard($table = "", $mode = "")
    {
        $this->scripts[] = "category-validation";

        $view = (! empty($table) && ! empty($mode)) ? $mode ."-" .$table : "dashboard";
        $categories = $this->dba->getTable("categories")->getAll(null, null, true);
        
        $this->title = "Dashboard";
        $this->loadView($view, array("categories" => $categories));
    }
}
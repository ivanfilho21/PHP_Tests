<?php

namespace App\Controller;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct("Home");
    }

    public function index()
    {
        $categories = $this->dba->getTable("categories")->getAll();
        $categories = ! empty($categories) ? $categories : array();

        $boards = $this->dba->getTable("boards")->getAll();
        $boards = ! empty($boards) ? $boards : array();

        $viewData["categories"] = $categories;
        $viewData["boards"] = $boards;
         
        $this->title = "Home Page";
        $this->loadView("home", $viewData);

        echo (! empty($this->user)) ? "Bem vindo, " .$this->user->getUsername() : "";
    }
}
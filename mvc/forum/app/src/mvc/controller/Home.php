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
    }
}
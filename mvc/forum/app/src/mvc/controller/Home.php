<?php

use \App\Controller\Controller;

class Home extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        $this->title = "Home Page";
        $this->loadView("home");
    }
}
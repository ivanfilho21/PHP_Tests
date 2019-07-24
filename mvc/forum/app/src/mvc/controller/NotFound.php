<?php

use \App\Controller\Controller;

class NotFound extends Controller
{
    public function __construct()
    {
        parent::__construct("NotFound");
        $this->template = "blank";
    }

    public function index()
    {
        $this->title = "Page Not Found";
        $this->loadView("404");
    }
}
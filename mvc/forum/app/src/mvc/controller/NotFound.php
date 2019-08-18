<?php

namespace App\Controller;

class NotFound extends Controller
{
    public function __construct()
    {
        parent::__construct("NotFound", false);
        $this->template = "blank";
    }

    public function index()
    {
        $this->title = "Page Not Found";
        $this->loadView("404");
    }
}
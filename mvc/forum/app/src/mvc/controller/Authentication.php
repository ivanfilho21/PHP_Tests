<?php

use \App\Controller\Controller;

class Authentication extends Controller
{
    public function __construct()
    {
        parent::__construct("authentication");
        $this->styles[] = "auth-general";
    }

    public function index()
    {}

    public function login()
    {
        $this->title = "Sign In";
        $this->loadView("sign-in");
    }

    public function register()
    {
        $this->title = "Sign Up";
        $this->styles[] = "sign-up";
        $this->scripts[] = "sign-up-validation";
        $this->loadView("sign-up");
    }
}
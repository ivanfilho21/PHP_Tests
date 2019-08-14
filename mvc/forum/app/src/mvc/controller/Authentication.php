<?php

namespace App\Controller;

class Authentication extends Controller
{
    public function __construct()
    {
        parent::__construct("authentication");
        $this->styles[] = array(
            "path" => REL_PAGE .$this->controllerName ."css/",
            "name" => "auth-general"
        );
    }

    public function index()
    {}

    public function login()
    {
        $this->checkUserLogged(false);

        require "scripts/server/login-submit.php";

        $this->title = "Login";
        $this->styles[] = array(
            "path" => REL_PAGE .$this->controllerName ."css/",
            "name" => "sign-in"
        );
        $this->scripts[] = array(
            "path" => REL_PAGE .$this->controllerName ."js/",
            "name" => "sign-in-validation",
            "defer" => "on"
        );
        $this->loadView("login");
    }

    public function register()
    {
        $this->checkUserLogged(false);

        $this->title = "Nova Conta";
        $this->styles[] = array(
            "path" => REL_PAGE .$this->controllerName ."css/",
            "name" => "sign-up"
        );
        $this->scripts[] = array(
            "path" => REL_PAGE .$this->controllerName ."js/",
            "name" => "sign-up-validation",
            "defer" => "on"
        );
        $this->loadView("sign-up");
    }

    public function logout()
    {
        $this->auth->deleteUserSession();
        $this->auth->deleteUserCookie();

        echo "Saindo...";
        redirect("home", true, 2000);
    }
}
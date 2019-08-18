<?php

namespace App\Controller;

class Authentication extends Controller
{
    public function __construct()
    {
        parent::__construct("Authentication", false);
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

        require "scripts/login-submit.php";

        $this->title = "Login";
        $this->styles[] = array(
            "path" => REL_PAGE .$this->controllerName ."css/",
            "name" => "login"
        );
        $this->loadView("login");
    }

    public function register()
    {
        $this->checkUserLogged(false);

        require "scripts/register-submit.php";

        $this->title = "Nova Conta";
        $this->styles[] = array(
            "path" => REL_PAGE .$this->controllerName ."css/",
            "name" => "register"
        );
        $this->loadView("register");
    }

    public function logout()
    {
        $this->auth->deleteUserSession();
        $this->auth->deleteUserCookie();

        echo "Saindo...";
        redirect("home", true, 2000);
    }
}
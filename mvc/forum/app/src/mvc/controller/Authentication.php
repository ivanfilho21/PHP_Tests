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
        $this->checkUserLogged();

        $this->title = "Login";
        $this->styles[] = "sign-in";
        $this->scripts[] = "sign-in-validation";
        $this->loadView("sign-in");
    }

    public function register()
    {
        $this->checkUserLogged();

        $this->title = "Nova Conta";
        $this->styles[] = "sign-up";
        $this->scripts[] = "sign-up-validation";
        $this->loadView("sign-up");
    }

    public function logout()
    {
        $this->auth->deleteUserSession();
        $this->auth->deleteUserCookie();

        echo "Saindo...";
        redirect("home", true, 2000);
    }

    private function checkUserLogged()
    {
        if (! empty($this->user)) {
            redirect("home");
        }
    }
}
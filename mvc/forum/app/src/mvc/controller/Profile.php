<?php

namespace App\Controller;

class Profile extends Controller
{
    public function __construct()
    {
        parent::__construct("Profile");
    }

    public function index()
    {
        redirect("home");
    }

    public function open($userUrl = "")
    {
        $user = $this->auth->getUser(array("url" => $userUrl));
        if (empty($user)) redirect("home");

        $this->title = "Perfil de " .$user->getUsername();
        $this->pages[] = array("name" => $this->title, "url" => URL ."users/" .$userUrl, "active" => true);

        $viewData["user"] = $user;
        $this->loadView("profile", $viewData);
    }
}
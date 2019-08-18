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

        $this->styles[] = array(
            "path" => ASSETS ."css/",
            "name" => "forum"
        );

        $viewData["user"] = $user;
        $this->loadView("profile", $viewData);
    }

    public function edit($userUrl = "")
    {
        if (empty($userUrl)) redirect("home");

        if (empty($this->user)) redirect("home");

        $user = $this->auth->getUser(array("id" => $this->user->getId(), "url" => $userUrl));
        if (empty($user)) redirect("home");

        $this->title = "Edital Perfil";
        $this->pages[] = array("name" => "Perfil de " .$user->getUsername(), "url" => URL ."users/" .$userUrl);
        $this->pages[] = array("name" => $this->title, "url" => URL ."profile/edit/" .$userUrl, "active" => true);

        $this->scripts[] = array(
            "path" => ASSETS ."js/tinymce/",
            "name" => "tinymce.min"
        );

        $viewData["user"] = $user;
        $this->loadView("profile-edit", $viewData);
    }
}
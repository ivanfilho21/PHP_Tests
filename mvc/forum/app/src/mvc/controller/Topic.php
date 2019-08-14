<?php

namespace App\Controller;

class Topic extends Controller
{
    public function __construct()
    {
        parent::__construct("Topic");
        $this->scripts[] = array(
            "path" => ASSETS ."js/tinymce/",
            "name" => "tinymce.min"
        );
        $this->scripts[] = array(
            "path" => ASSETS ."js/",
            "name" => "validation",
            "defer" => "on"
        );
        $this->scripts[] = array(
            "path" => REL_PAGE .$this->controllerName ."js/",
            "name" => "initialize",
            "defer" => "on"
        );
        $this->scripts[] = array(
            "path" => REL_PAGE .$this->controllerName ."js/",
            "name" => "validation",
            "defer" => "on"
        );
    }

    public function index()
    {
        redirect("home");
    }

    public function open($url = "")
    {
        if (empty($url)) {
            redirect("home");
        }
    }

    public function create($boardId = "")
    {
        $this->checkUserLogged();

        require "scripts/server/topic-submit.php";

        $viewData["boardId"] = (! empty($boardId)) ? $boardId : 0;
        $viewData["boards"] = $this->dba->getTable("boards")->getAll();
        $this->title = "Novo Tópico";
        $this->loadView("create-topic", $viewData);
    }
}
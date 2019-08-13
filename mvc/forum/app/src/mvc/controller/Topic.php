<?php

namespace App\Controller;

class Topic extends Controller
{
    public function __construct()
    {
        parent::__construct("Topic");
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
        $viewData["boardId"] = (! empty($boardId)) ? $boardId : 0;
        $viewData["boards"] = $this->dba->getTable("boards")->getAll();
        $this->title = "Novo Tópico";
        $this->loadView("create-topic", $viewData);
    }
}
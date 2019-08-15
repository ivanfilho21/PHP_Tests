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

        $topic = $this->dba->getTable("topics")->get(array("url" => $url));
        $author = $this->dba->getTable("users")->get(array("id" => $topic->getAuthorId()));

        $viewData["author"] = $author;
        $viewData["topic"] = $topic;

        $this->title = $topic->getTitle();
        $this->loadView("topic", $viewData);
    }

    public function create($boardId = "")
    {
        $this->checkUserLogged();

        require "scripts/topic-submit.php";

        $boards = array();
        $cats = array();
        $categories = $this->dba->getTable("categories")->getAll();
        foreach ($categories as $c) {
            $where = array("category_id" => $c->getId());
            $b = $this->dba->getTable("boards")->getAll($where);
            if (empty($b)) continue;

            $cats[$c->getName()] = $b;
        }

        $viewData["boardId"] = (! empty($boardId)) ? $boardId : 0;
        $viewData["boards"] = $cats;



        $this->title = "Novo Tópico";
        $this->loadView("create-topic", $viewData);
    }
}
<?php

namespace App\Controller;

class Board extends Controller
{
    public function __construct()
    {
        parent::__construct("Board");
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
        $board = $this->dba->getTable("boards")->get(array("url" => $url));
        $topics = $this->dba->getTable("boards")->getTopics($this->dba, $board);
        $category = $this->dba->getTable("categories")->get(array("id" => $board->getCategoryId()));

        for ($i=0; $i < count($topics); $i++) {
            $author = $this->dba->getTable("topics")->getAuthor($this->dba, $topics[$i]);
            $topics[$i]->setAuthor($author);
            $topics[$i]->setUrl(encodeUrlFromName($topics[$i]->getTitle()));
        }

        $this->title = $board->getName();
        $this->pages[] = array("name" => "Início", "url" => URL);
        $this->pages[] = array("name" => $this->title, "url" => URL ."boards/" .$board->getUrl(), "active" => true);

        $viewData["category"] = $category;
        $viewData["board"] = $board;
        $viewData["topics"] = $topics;
         
        $this->loadView("board", $viewData);
    }
}
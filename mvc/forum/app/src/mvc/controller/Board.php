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

    public function open($url = "", $page = 1)
    {
        if (empty($url)) {
            redirect("home");
        }

        $limitPerPage = 15;

        $board = $this->dba->getTable("boards")->get(array("url" => $url));
        $topics = $this->dba->getTable("boards")->getTopics($this->dba, $board, $limitPerPage, $page);
        $category = $this->dba->getTable("categories")->get(array("id" => $board->getCategoryId()));

        for ($i=0; $i < count($topics); $i++) {
            $author = $this->dba->getTable("topics")->getAuthor($this->dba, $topics[$i]);
            $topics[$i]->setAuthor($author);
            $topics[$i]->setUrl(encodeUrlFromName($topics[$i]->getTitle()));
        }

        $this->title = $board->getName();
        $this->pages[] = array("name" => "Início", "url" => URL);
        $this->pages[] = array("name" => $this->title, "url" => URL ."boards/" .$board->getUrl(), "active" => true);

        $topicsQty = count($this->dba->getTable("boards")->getTopics($this->dba, $board));
        $pages = ($limitPerPage > 0) ? ceil($topicsQty / $limitPerPage) : 1;

        if ($page <= 0 || $page > $pages) {
            redirect("boards/" .$board->getUrl() ."/1");
        }

        $viewData["category"] = $category;
        $viewData["board"] = $board;
        $viewData["topics"] = $topics;
        $viewData["page"] = $page;
        $viewData["pages"] = $pages;
         
        $this->loadView("board", $viewData);
    }
}
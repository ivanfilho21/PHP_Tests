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
        $board = $this->dba->getTable("boards")->get("url", $url);
        $category = $this->dba->getTable("categories")->get("id", $board->getCategoryId());

        $where = array("id" => $board->getId());
        $topics = $this->dba->getTable("topics")->getAll(array(), array("board_id" => $board->getId()));
        $topics = (! empty($topics)) ? $topics : array();

        for ($i=0; $i < count($topics); $i++) {
            $where = array("id" => $topics[$i]->getAuthorId());
            $author = $this->dba->getTable("users")->get($where, null);
            $topics[$i]->setAuthor($author);
        }

        $viewData["category"] = $category;
        $viewData["board"] = $board;
        $viewData["topics"] = $topics;
         
        $this->title = $board->getName();
        $this->loadView("board", $viewData);
    }
}
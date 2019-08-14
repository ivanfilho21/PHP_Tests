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
        $category = $this->dba->getTable("categories")->get(array("id" => $board->getCategoryId()));
        
        $topics = $this->dba->getTable("topics")->getAll(array("board_id" => $board->getId()));
        $topics = (! empty($topics)) ? $topics : array();

        for ($i=0; $i < count($topics); $i++) {
            $where = array("id" => $topics[$i]->getAuthorId());
            $author = $this->dba->getTable("users")->get($where);
            $topics[$i]->setAuthor($author);
        }

        $viewData["category"] = $category;
        $viewData["board"] = $board;
        $viewData["topics"] = $topics;
         
        $this->title = $board->getName();
        $this->loadView("board", $viewData);
    }
}
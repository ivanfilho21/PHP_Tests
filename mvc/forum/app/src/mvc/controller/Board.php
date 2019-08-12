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

        $viewData["category"] = $category;
        $viewData["board"] = $board;
         
        $this->title = $board->getName();
        $this->loadView("board", $viewData);
    }
}
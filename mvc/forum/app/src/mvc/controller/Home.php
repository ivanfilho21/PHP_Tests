<?php

namespace App\Controller;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct("Home");
    }

    public function index()
    {
        $categories = $this->dba->getTable("categories")->getAll();
        $categories = ! empty($categories) ? $categories : array();

        $boards = $this->dba->getTable("boards")->getAll();
        $boards = ! empty($boards) ? $boards : array();

        for ($i=0; $i < count($boards); $i++) {
            $where = array("board_id" => $boards[$i]->getId());
            $topic = $this->dba->getTable("topics")->get($where, null);
            
            if (! empty($topic)) {
                $where = array(
                    "id" => $topic->getAuthorId()
                );
                $author = $this->dba->getTable("users")->get($where, null);
                $topic->setAuthor($author);
                $boards[$i]->setLatestTopic($topic);
            }
            $where = array("id" => $boards[$i]->getModeratorId());
            $moderator = $this->dba->getTable("users")->get($where, null);

            if (! empty($moderator)) {
                $boards[$i]->setModerator($moderator);
            }
        }

        $viewData["categories"] = $categories;
        $viewData["boards"] = $boards;
         
        $this->title = "Home Page";
        $this->loadView("home", $viewData);

        echo (! empty($this->user)) ? "Bem vindo, " .$this->user->getUsername() : "";
    }
}
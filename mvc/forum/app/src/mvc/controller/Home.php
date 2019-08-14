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
            $topic = $this->dba->getTable("topics")->getLatest($boards[$i]->getId());
            
            if (! empty($topic)) {
                $author = $this->dba->getTable("topics")->getAuthor($this->dba, $topic);
                $topic->setAuthor($author);
                $boards[$i]->setLatestTopic($topic);
            }
            $where = array("id" => $boards[$i]->getModeratorId());
            $moderator = $this->dba->getTable("users")->get($where);

            if (! empty($moderator)) {
                $boards[$i]->setModerator($moderator);
            }
            // $boards[$i]->setUrl(implode("-", explode(" ", strtolower($boards[$i]->getName()))));
        }

        $viewData["categories"] = $categories;
        $viewData["boards"] = $boards;
         
        $this->title = "Home Page";
        $this->loadView("home", $viewData);

        echo (! empty($this->user)) ? "Bem vindo, " .$this->user->getUsername() : "";
    }
}
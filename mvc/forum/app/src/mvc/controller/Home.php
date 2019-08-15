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
        $this->title = "";
        $this->pages[] = array("name" => "Início", "url" => URL, "active" => true);

        $categories = $this->dba->getTable("categories")->getAll();
        $categories = ! empty($categories) ? $categories : array();

        $boards = $this->dba->getTable("boards")->getAll();
        $boards = ! empty($boards) ? $boards : array();

        $topicsQty = 0;
        $postsQty = 0;

        for ($i=0; $i < count($boards); $i++) {
            $tpcs = $this->dba->getTable("boards")->getTopics($this->dba, $boards[$i]);
            $topicsQty += count($tpcs);
            foreach ($tpcs as $t) {
                $pts = $this->dba->getTable("topics")->getPosts($this->dba, $t);
                $postsQty += count($pts);
            }

            # Get latest topic
            $topic = (count($tpcs) > 0) ? $tpcs[count($tpcs) -1] : false;
            
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
            // $boards[$i]->setUrl(encodeUrlFromName($boards[$i]->getName()));
        }

        $viewData["categories"] = $categories;
        $viewData["boards"] = $boards;
        $viewData["topicsQty"] = $topicsQty;
        $viewData["postsQty"] = $postsQty;
       
        $this->loadView("home", $viewData);

        echo (! empty($this->user)) ? "Bem vindo, " .$this->user->getUsername() : "";
    }
}
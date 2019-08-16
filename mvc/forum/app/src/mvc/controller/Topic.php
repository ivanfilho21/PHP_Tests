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

    public function open($url = "", $page = 1)
    {
        if (empty($url)) {
            redirect("home");
        }

        $topic = $this->dba->getTable("topics")->get(array("url" => $url));

        if (empty($topic)) {
            redirect("home");
        }

        $limitPerPage = 10;
        $board = $this->dba->getTable("boards")->get(array("id" => $topic->getBoardId()));

        $this->title = $topic->getTitle();
        $this->pages[] = array("name" => "Início", "url" => URL);
        $this->pages[] = array("name" => $board->getName(), "url" => URL ."boards/" .$board->getUrl());
        $this->pages[] = array("name" => $topic->getTitle(), "url" => URL ."topics/create", "active" => true);

        $topicAuthor = $this->dba->getTable("topics")->getAuthor($this->dba, $topic);
        $posts = $this->dba->getTable("topics")->getPosts($this->dba, $topic, $limitPerPage, $page);
        
        # Topic Views
        $topic->setViews($topic->getViews() + 1);
        $this->dba->getTable("topics")->edit($topic);

        $postsQty = count($this->dba->getTable("topics")->getPosts($this->dba, $topic));
        $pages = ($limitPerPage > 0) ? ceil($postsQty / $limitPerPage) : 1;

        if ($page <= 0 || $page > $pages) {
            redirect("boards/" .$board->getUrl() ."/1");
        }

        $viewData["author"] = $topicAuthor;
        $viewData["topic"] = $topic;
        $viewData["posts"] = $posts;
        $viewData["page"] = $page;
        $viewData["pages"] = $pages;
        $viewData["baseUrl"] = URL ."topics/" .$topic->getUrl() ."/";

        require "scripts/post-submit.php";

        $this->loadView("topic", $viewData);
    }

    public function create($boardId = "")
    {
        $this->checkUserLogged();

        require "scripts/topic-submit.php";

        $this->title = "Novo Tópico";
        $this->pages[] = array("name" => "Início", "url" => URL);
        // $this->pages[] = array("name" => $board->getName(), "url" => URL ."boards/" .$board->getUrl());
        $this->pages[] = array("name" => $this->title, "url" => URL ."topic/create", "active" => true);

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



        $this->loadView("create-topic", $viewData);
    }

    public function edit($url = "", $postId = 0)
    {
        $this->checkUserLogged();

        if (empty($url) || empty($postId)) { redirect("home"); }

        # Check if current user is author of post to edit
    }
}
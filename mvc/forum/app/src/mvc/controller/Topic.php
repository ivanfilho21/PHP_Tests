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

    public function open($url = "", $page = 1, $postId = 0)
    {
        if (empty($url)) {
            redirect("home");
        }

        $topic = $this->dba->getTable("topics")->get(array("url" => $url));
        if (empty($topic)) redirect("home");

        $post = $this->dba->getTable("posts")->get(array("topic_id" => $topic->getId()));
        $topic->setPost($post);


        $limitPerPage = 1;
        $board = $this->dba->getTable("boards")->get(array("id" => $topic->getBoardId()));
        if (empty($board)) redirect("home");

        $this->title = $topic->getTitle();
        $this->pages[] = array("name" => "Início", "url" => URL);
        $this->pages[] = array("name" => $board->getName(), "url" => URL ."boards/" .$board->getUrl());
        $this->pages[] = array("name" => $topic->getTitle(), "url" => URL ."topics/create", "active" => true);

        $topicAuthor = $this->dba->getTable("topics")->getAuthor($this->dba, $topic);
        $posts = $this->dba->getTable("topics")->getPosts($this->dba, $topic, $limitPerPage, $page);
        // var_dump($posts);
        
        # Topic Views
        $topic->setViews($topic->getViews() + 1);
        $this->dba->getTable("topics")->edit($topic);

        $postsQty = count($this->dba->getTable("topics")->getPosts($this->dba, $topic));
        $pages = ($limitPerPage > 0) ? ceil($postsQty / $limitPerPage) : 1;
        $pages = ($pages == 0) ? 1 : $pages;

        if ($page <= 0 || $page > $pages) {
            redirect("boards/" .$board->getUrl() ."/1");
        }

        if (! empty($postId)) {
            # Editing a post different from the Topic First Post
            $editPost = $this->dba->getTable("topics")->getPost($this->dba, $topic, $postId);
            $viewData["editPost"] = $editPost;
            require "scripts/post-edit-submit.php";
        } else {
            require "scripts/post-submit.php";
        }

        $viewData["author"] = $topicAuthor;
        $viewData["topic"] = $topic;
        $viewData["posts"] = $posts;
        $viewData["page"] = $page;
        $viewData["pages"] = $pages;
        $viewData["limitPerPage"] = $limitPerPage;
        $viewData["baseUrl"] = URL ."topics/" .$topic->getUrl() ."/";


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

        $cats = $this->getCategoriesAndBoards();

        $viewData["boardId"] = (! empty($boardId)) ? $boardId : 0;
        $viewData["boards"] = $cats;

        $this->loadView("create-topic", $viewData);
    }

    public function edit($url = "")
    {
        $this->checkUserLogged();
        if (empty($url)) redirect("home");

        $topic = $this->dba->getTable("topics")->get(array("url" => $url));
        if (empty($topic)) redirect("topics/" .$url);
        if ($topic->getAuthorId() != $this->user->getId()) redirect("topics/" .$url);

        $board = $this->dba->getTable("boards")->get(array("id" => $topic->getBoardId()));
        if (empty($board)) redirect("home");
        
        # Check if current user is author of post to edit
        $post = $this->dba->getTable("topics")->getPost($this->dba, $topic, $topic->getPostId());
        if (empty($post)) redirect("boards/" .$board->getUrl());

        $this->title = "Editar Tópico";
        $this->pages[] = array("name" => "Início", "url" => URL);
        $this->pages[] = array("name" => $board->getName(), "url" => URL ."boards/" .$board->getUrl());
        $this->pages[] = array("name" => $this->title, "url" => URL ."topic/create", "active" => true);

        $cats = $this->getCategoriesAndBoards();

        $viewData["boardId"] = $board->getId();
        $viewData["boards"] = $cats;
        $viewData["topic"] = $topic;
        $viewData["post"] = $post;

        require "scripts/topic-submit.php";
        $this->loadView("create-topic", $viewData);
    }

    private function getCategoriesAndBoards()
    {
        $cats = array();
        $categories = $this->dba->getTable("categories")->getAll();
        foreach ($categories as $c) {
            $where = array("category_id" => $c->getId());
            $b = $this->dba->getTable("boards")->getAll($where);
            if (empty($b)) continue;

            $cats[$c->getName()] = $b;
        }
        return (! empty($cats)) ? $cats : array();
    }
}
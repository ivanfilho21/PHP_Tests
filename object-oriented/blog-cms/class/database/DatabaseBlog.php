<?php

require "../class/database/dao/PostDAO.php";

class DatabaseBlog
{
    private $postDAO;

    public function __construct()
    {
        $this->mysqli = new mysqli(DB_BLOG_SERVER, DB_BLOG_USER, DB_BLOG_PASS, DB_BLOG_NAME);

        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
            die();
        }

        $this->postDAO = new PostDAO();
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }
}
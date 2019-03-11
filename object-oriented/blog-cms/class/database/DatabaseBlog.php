<?php

require "class/database/dao/PostDAO.php";

class DatabaseBlog
{
    private $database;
    private $postDAO;

    public function __construct()
    {
        $this->database = new Database(DB_ADMIN_SERVER, DB_ADMIN_USER, DB_ADMIN_PASS, DB_ADMIN_NAME);

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
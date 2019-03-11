<?php
require "class/database/dao/UserDAO.php";
require "class/database/dao/PageDAO.php";

class DatabaseAdmin
{
    private $dbServer = "127.0.0.1";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "blog_admin_db";
    

    public function __construct()
    {
        $this->database = new Database(DB_ADMIN_SERVER, DB_ADMIN_USER, DB_ADMIN_PASS, DB_ADMIN_NAME);

        $this->userDAO = new UserDAO();
        $this->pageDAO = new PageDAO();

        $mysqli = $this->database->getMysqli();

        $this->userDAO->createTable($mysqli);
        $this->pageDAO->createTable($mysqli);

        # Test create user
        $this->userDAO->createUser("admin", "admin");
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
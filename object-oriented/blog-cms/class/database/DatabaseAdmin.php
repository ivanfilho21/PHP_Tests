<?php
require "../class/database/dao/UserDAO.php";
require "../class/database/dao/PageDAO.php";

class DatabaseAdmin
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli(DB_ADMIN_SERVER, DB_ADMIN_USER, DB_ADMIN_PASS, DB_ADMIN_NAME);

        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
            die();
        }

        $this->userDAO = new UserDAO();
        $this->pageDAO = new PageDAO();

        $this->userDAO->createTable($this->mysqli);
        $this->pageDAO->createTable($this->mysqli);

        # Test inserting new user to db
        # $this->userDAO->createUser($this->mysqli, "admin", "admin");
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getUserDAO()
    {
        return $this->userDAO;
    }
}
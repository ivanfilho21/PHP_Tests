<?php
define("DB_TYPE", "mysql");
define("DB_NAME", "agenda_db");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

class DB
{
    private $pdo;

    private function __construct()
    {
        $dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

        $this->pdo = new PDO($dsn, $dbUser, $dbPass);
    }

    public static function getInstance()
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new DB();
        }
        return $instance;
    }

    public function getPDO()
    {
        return $this->pdo;
    }

}
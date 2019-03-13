<?php
require ROOT_PATH . "/class/database/dao/PostDAO.php";

class DatabaseBlog
{
    private $postDAO;

    public function __construct()
    {
        $db = $this->connectToDatabase();

        $this->postDAO = new PostDAO($db);
    }

    private function connectToDatabase()
    {
        # Configuring database with PDO

        $dsn = DB_TYPE . ":dbname=" . DB_ADMIN_NAME . ";host=" . DB_HOST;
        $dbuser = DB_USER;
        $dbpass = DB_PASS;
        # echo "<br>".$dsn."<br>".$dbuser."<br>".$dbpass;

        return DatabaseUtils::getDatabaseConnection($dsn, $dbuser, $dbpass);
    }
}
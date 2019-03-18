<?php
require ROOT_PATH . "/class/database/dao/UserDAO.php";
require ROOT_PATH . "/class/database/dao/PageDAO.php";

/**
* Class: UserDAO
* 
* Manages all entities in database_admin.
*
* @package      blog-cms
* @subpackage   class/database/dao
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 18, 2019.
*/

class DatabaseAdmin
{
    private $userDAO;
    private $pageDAO;

    public function __construct()
    {
        $db = $this->connectToDatabase();

        $this->userDAO = new UserDAO($db);
        $this->pageDAO = new PageDAO($db);

        # Create tables
        $this->userDAO->createTable();
        $this->pageDAO->createTable();

        # Test inserting new user to db
        # $this->userDAO->createUser($this->mysqli, "admin", "admin");
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

    public function getUserDAO()
    {
        return $this->userDAO;
    }
}
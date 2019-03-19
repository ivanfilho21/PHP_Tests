<?php
require ROOT_PATH . "/class/database/dao/UserDAO.php";

/**
* Class: Database
* 
* Manages all tables (daos) in the database.
*
* @package      login-system
* @subpackage   class/database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 19, 2019.
*/

class Database
{
    private $userDAO;

    public function __construct()
    {
        $db = $this->connectToDatabase();

        $this->userDAO = new UserDAO($db);

        # Create tables
        $this->userDAO->createTable();

        # Test inserting new user to db
        # $this->userDAO->createUser($this->mysqli, "admin", "admin");
    }

    private function connectToDatabase()
    {
        # Configuring database with PDO

        $dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
        $dbuser = DB_USER;
        $dbpass = DB_PASS;
        # echo "<br>".$dsn."<br>".$dbuser."<br>".$dbpass; die();

        $pdo = null;

        try {
            $pdo = new PDO($dsn, $dbuser, $dbpass);
            # echo "Connected to Database via PDO<br>"; die();
        } catch(PDOException $e) {
            echo "Warning: Failed connecting to database.<br><strong>Returned Error:</strong> " .$e->getMessage() . "<br>";
        }
        return $pdo;
    }

    public function getUserDAO()
    {
        return $this->userDAO;
    }

}
<?php
require ROOT_PATH . "/class/database/dao/PostDAO.php";

/**
* Class: UserDAO
* 
* Manages all entities in database_blog.
*
* @package      blog-cms
* @subpackage   class/database/dao
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 18, 2019.
*/

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
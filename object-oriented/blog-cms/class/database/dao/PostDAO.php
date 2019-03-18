<?php

/**
* Class: UserDAO
* 
* Database operations related to the Post entity.
*
* @package      blog-cms
* @subpackage   class/database/dao
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 18, 2019.
*/

class PostDAO extends DAO
{
    public function __construct($db)
    {
        parent::__construct($db);
    }
    # Override
    public function createTable()
    {
        $this->createTableInDatabase();
    }
    
    # Override
    public function dropTable()
    {
        $this->dropTableInDatabase();
    }
}
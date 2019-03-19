<?php

/**
* Class: PageDAO
* 
* Database operations related to the Page entity.
*
* @package      blog-cms
* @subpackage   class/database/dao
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 18, 2019.
*/

class PageDAO extends DAO
{
    public function __construct($db)
    {
        parent::__construct($db);
        $this->tableName = "pages";
        $this->columns[] = new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("title", VARCHAR, 11, false, "", "");
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
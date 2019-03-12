<?php

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
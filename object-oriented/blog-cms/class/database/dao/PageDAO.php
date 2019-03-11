<?php

class PageDAO extends DAO
{
    public function __construct()
    {
        $this->tableName = "pages";
        $this->columns[] = new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("title", VARCHAR, 11, false, "", "");
    }

    # Override
    public function createTable($mysqli)
    {
        $this->createTableInDatabase($mysqli);
    }

    # Override
    public function dropTable($mysqli)
    {
        $this->dropTableInDatabase($mysqli);
    }
}
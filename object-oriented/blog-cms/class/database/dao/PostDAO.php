<?php

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
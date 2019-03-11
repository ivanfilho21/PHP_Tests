<?php

class PostDAO extends DAO
{
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
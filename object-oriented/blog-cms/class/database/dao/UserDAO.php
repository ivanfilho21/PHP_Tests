<?php

class UserDAO extends DAO
{
    public function __construct()
    {
        $this->tableName = "users";
        $this->columns[] = new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("username", VARCHAR, 255, false, "", "");
        $this->columns[] = new Column("password", VARCHAR, 255, false, "", "");
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

    # CRUD

    public function createUser($username, $password)
    {
        $fields = DatabaseUtils::getTableFields($this->columns, false);
        $values = "";
        $values .= QT . $username . QT . COMMA . MD5 . "(" . QT . $password . QT . ")";

        $sql = "INSERT INTO " . QT_A . $this->tableName . QT_A . " (" . $fields . ") VALUES (" . $values . ")";
        echo $sql;
    }
}
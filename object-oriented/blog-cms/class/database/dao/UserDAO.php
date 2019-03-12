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
        parent::createTableInDatabase($mysqli);
    }

    # Override
    public function dropTable($mysqli)
    {
        parent::dropTableInDatabase($mysqli);
    }

    # CRUD

    public function createUser($mysqli, $username, $password)
    {
        $values = "";
        $values .= QT . $username . QT . COMMA . MD5 . "(" . QT . $password . QT . ")";

        parent::insert($mysqli, $values);
    }

    public function select($columnNames = "*", $where = "")
    {
        $columns = "";

        if (is_array($columnNames)) {
            foreach ($columnNames as $k => $name) {
                $columns .= QT_A . $name . QT_A . COMMA;
            }
            $columns = substr($columns, 0, strlen($columns) - strlen(COMMA));
        } else {
            $columns = $columnNames;
        }
        echo $columns;

        $sql = "SELECT " . $columns . " FROM " . QT_A . $this->tableName . QT_A . "";

    }
}
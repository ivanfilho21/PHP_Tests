<?php

require dirname(__FILE__) . "/../../../class/User.php";

class UserDAO extends DAO
{
    public function __construct($db)
    {
        parent::__construct($db);

        $this->tableName = "users";
        $this->columns[] = new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("username", VARCHAR, 18, false, "", "");
        $this->columns[] = new Column("password", VARCHAR, 32, false, "", "");
    }

    # Override
    public function createTable()
    {
        parent::createTableInDatabase();
    }

    # Override
    public function dropTable()
    {
        parent::dropTableInDatabase();
    }

    # CRUD

    public function createUser($username, $password)
    {
        $values = "";
        $values .= QT . $username . QT . COMMA . MD5 . "(" . QT . $password . QT . ")";

        parent::insert($values);
    }

    public function select($columns = "*", $whereColumns = "", $whereValues = "")
    {
        $whereClause = "";
        if (! empty($whereColumns)) {
            $whereClause .= "WHERE ";

            foreach ($whereColumns as $k => $v) {
                $whereClause .= QT_A . $v . QT_A . " = " . QT . $whereValues[$k] . QT;
            }
        }

        $sql = "SELECT " . $columns . " FROM " . QT_A . $this->tableName . QT_A . $whereClause;
        echo $sql;

    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }
}
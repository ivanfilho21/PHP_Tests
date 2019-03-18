<?php
require ROOT_PATH . "/class/User.php";

class UserDAO extends DAO
{
    public function __construct($db)
    {
        parent::__construct($db);

        $this->tableName = "users";
        $this->columns[] = new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("email", VARCHAR, 255, false, "", "");
        $this->columns[] = new Column("username", VARCHAR, 255, false, "", "");
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

    public function createUser($user)
    {
        $email = $user->getEmail();
        $name = $user->getUsername();
        $pass = $user->getPassword();

        $values = "";
        $values .= QT . $email . QT . COMMA .QT . $name . QT . COMMA . MD5 . "(" . QT . $pass . QT . ")";

        parent::insert($values);
    }

    # How to use:
    # $columns = name of columns to be returned. type string
    # $whereColumns = name of columns in where statement. type array
    # $whereValues = value of columns in where statement. type array
    public function select($columns = "*", $whereColumns = "", $whereValues = "")
    {
        $whereClause = "";
        if (! empty($whereColumns)) {
            $whereClause .= " WHERE ";

            foreach ($whereColumns as $k => $v) {
                $whereClause .= QT_A . $v . QT_A . " = ";

                if (strpos($whereValues[$k], "MD5") !== false)
                    $whereClause .= $whereValues[$k] . " AND ";
                else
                    $whereClause .= QT . $whereValues[$k] . QT . " AND ";
            }
            $whereClause = substr($whereClause, 0, - strlen(" AND "));
        }

        $sql = "SELECT " . $columns . " FROM " . QT_A . $this->tableName . QT_A . $whereClause;
        # echo $sql . "<br>"; die();

        $res = $this->query($sql);
        $user = null;

        if ($res->rowCount() > 0) {
            $user = new User(0, "", "", "");

            foreach ($res->fetchAll() as $userDB) {
                $user->setId($userDB["id"]);
                $user->setEmail($userDB["email"]);
                $user->setUsername($userDB["username"]);
                $user->setPassword($userDB["password"]);
            }
        }

        return $user;
    }

    public function query($sql)
    {
        return parent::executeQuery($sql);
    }
}
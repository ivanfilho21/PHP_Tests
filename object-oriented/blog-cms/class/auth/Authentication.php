<?php

class Authentication
{
    private $dbAdmin;

    public function __construct($dbAdmin)
    {
        $this->dbAdmin = $dbAdmin;
    }

    # Static method
    public function getLoggedUser()
    {
        session_start();
        
        if (isset($_SESSION["user-session"])) {
            $name = $_SESSION["user-session"]["username"];
            $pass = $_SESSION["user-session"]["password"];
            $user = new User(0, $name, $pass);

            return $user;
        }
        return null;
    }
    

    public function login($username, $password, bool $keepLogged)
    {
        if ($this->checkLoginInDatabase(new User(0, $username, $password))) {
            session_start();

            $_SESSION["user-session"]["username"] = $username;
            $_SESSION["user-session"]["password"] = $password;

            return true;
        } else {
            return false;
        }
    }

    # Returns true if the user exists in the database, false otherwise.
    
    private function checkLoginInDatabase($user)
    {
        $tableName = $this->dbAdmin->getUserDAO()->getTableName();
        $sql = "SELECT * FROM " . $tableName . " WHERE " . QT_A . "username" . QT_A . " = " . QT . $user->getUsername() . QT . " AND " . QT_A . "password" . QT_A . " = " . MD5 . "(" . QT . $user->getPassword() . QT . ")";

        # echo $sql;

        $res = $this->dbAdmin->getUserDAO()->query($sql);
        # echo "<br>rows " . $res->rowCount();
        
        if ($res->rowCount() == 1) {
            return true;
        }
        return false;
    }
}
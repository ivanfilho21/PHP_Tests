<?php

class Authentication
{
    private $dbAdmin;

    public function __construct($dbAdmin)
    {
        $this->dbAdmin = $dbAdmin;
    }

    public function register($username, $password) {
        # Check if user is already registered
        if ($this->checkUsernameInDatabase($username) == false) {
            $this->dbAdmin->getUserDAO()->createUser($username, $password);
            return true;
        }
        else {
            return false;
        }
    }

    public function login($username, $password, bool $keepLogged)
    {
        if ($this->checkLoginInDatabase(new User(0, $username, $password))) {
            $this->sessionStart();

            $_SESSION["user-session"]["username"] = $username;
            $_SESSION["user-session"]["password"] = $password;

            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION["user-session"]["username"] = null;
    }

    public function checkUserSession()
    {
        return $this->getLoggedUser() != null;
    }

    public function getLoggedUser()
    {
        $this->sessionStart();
        
        if (isset($_SESSION["user-session"])) {
            $name = $_SESSION["user-session"]["username"];
            $pass = $_SESSION["user-session"]["password"];
            $user = new User(0, $name, $pass);

            return $user;
        }
        return null;
    }

    # Private Methods

    private function checkUsernameInDatabase($username)
    {
        $tableName = $this->dbAdmin->getUserDAO()->getTableName();
        $sql = "SELECT * FROM " . $tableName . " WHERE " . QT_A . "username" . QT_A . " = " . QT . $username . QT;

        # echo $sql;

        $res = $this->dbAdmin->getUserDAO()->query($sql);
        # echo "<br>rows " . $res->rowCount();
        
        if ($res->rowCount() == 1) {
            return true;
        }
        return false;
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

    private function sessionStart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            return true;
        }
        return false;
    }
}
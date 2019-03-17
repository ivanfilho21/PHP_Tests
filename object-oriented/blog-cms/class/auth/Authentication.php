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

            # TODO: encrypt userInfo to put in a cookie
            $userInfo = "{$username};{$password}";

            if ($keepLogged) {
                setrawcookie("user-session", "{'" . $username . "':'" . $password . "'}", time() + (86400 * 30), "/");
            }

            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        $this->sessionStart();
        $this->deleteUserSession();
        $this->deleteUserCookie();
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
        }
        else if (isset($_COOKIE["user-session"])) {
            $cookie = $_COOKIE["user-session"];
            #echo $cookie;

            $userInfo = explode(":", $cookie);

            $name = substr($userInfo[0], 2, -1);
            $pass = substr($userInfo[1], 1, -2);
            #echo "<br>User: " . $name;
            #echo "<br>Pass: " . $pass;
        }
        else {
            return null;
        }

        $user = new User(0, $name, $pass);

        # Double check in database
        if ($this->checkLoginInDatabase($user)) {
            return $user;
        }
        else {
            $this->deleteUserSession();
            $this->deleteUserCookie();
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

    private function deleteUserSession() {
        $_SESSION["user-session"] = null;
    }

    private function deleteUserCookie() {
        setcookie("user-session", "", time()-3600, "/");
    }
}
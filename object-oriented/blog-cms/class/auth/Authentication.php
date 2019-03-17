<?php

class Authentication
{
    private $dbAdmin;

    public function __construct($dbAdmin)
    {
        $this->dbAdmin = $dbAdmin;
    }

    public function register($user) {
        # Check if email is already registered
        if ($this->checkEmailInDatabase($user->getEmail()) == false) {
            $this->dbAdmin->getUserDAO()->createUser($user);
            return true;
        }
        else {
            return false;
        }
    }

    # Checks email and password in database.
    # When user exists, create a user session and returns true.
    public function login($email, $password, bool $keepLogged)
    {
        $loggedUser = $this->checkLoginInDatabase($email, $password);
        
        if ($loggedUser != null) {
            $this->sessionStart();

            $_SESSION["user-session"]["email"] = $email;
            $_SESSION["user-session"]["password"] = $password;

            if ($keepLogged) {
                # TODO: encrypt userInfo to put in a cookie
                $userInfo = "{$email};{$password}";

                #setrawcookie("user-session", "{'" . $email . "':'" . $password . "'}", time() + (86400 * 30), "/");
                
                setrawcookie("user-session", $email . ":" . $password . "", time() + (86400 * 30), "/");
            }

            return true;
        }

        return false;
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
            $email = $_SESSION["user-session"]["email"];
            $pass = $_SESSION["user-session"]["password"];
        }
        else if (isset($_COOKIE["user-session"])) {
            $cookie = $_COOKIE["user-session"];
            #echo $cookie;

            $userInfo = explode(":", $cookie);

            #$email = substr($userInfo[0], 2, -1);
            #$pass = substr($userInfo[1], 1, -2);

            $email = $userInfo[0];
            $pass = $userInfo[1];

            #echo "<br>User: " . $name;
            #echo "<br>Pass: " . $pass;
        }
        else {
            # No user is logged
            return null;
        }

        # Now, user might not exist anymore in database.

        $user = null;

        # Double check in database
        $user = $this->checkLoginInDatabase($email, $pass);

        if ($user == null) {
            $this->deleteUserSession();
            $this->deleteUserCookie();
        } 

        return $user;
    }

    # Private Methods

    private function checkEmailInDatabase($email)
    {
        $res = $this->dbAdmin->getUserDAO()->select("*", array("email"), array("{$email}"));
        
        if ($res == null) {
            return false;
        }
        else {
            return true;
        }
    }

    # Returns true if the user exists in the database, false otherwise.
    private function checkLoginInDatabase($email, $password)
    {
        return $this->dbAdmin->getUserDAO()->select("*", array("email", "password"), array("{$email}", "MD5(" . QT . $password . QT . ")"));
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
<?php

namespace IvanFilho\Authentication;

use \User;
use \IvanFilho\Database\Table;

class Authentication
{
    public function __construct(Table $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function checkField($field, $value)
    {
        return $this->userDAO->get(array($field => $value)) !== false;
    }

    public function getUser(array $where)
    {
        return $this->userDAO->get($where);
    }

    public function insertUser(User $user)
    {
        $this->userDAO->insert($user);
    }

    public function updateUser(User $user)
    {
        $this->userDAO->edit($user);
    }

    public function register(User $user)
    {
        echo "Registration";
    }

    public function login(User $user, bool $keepSession = false)
    {
        $this->setUserSession($user);

        if ($keepSession) {
            $this->setUserCookie($user);
        }
    }

    public function securePassword($pass)
    {
        return md5($pass);
    }

    public function encode($str)
    {
        return urlencode(base64_encode($str));
    }

    public function decode($str)
    {
        return base64_decode(urldecode($str));
    }

    public function deleteUserSession()
    {
        unset($_SESSION["user-session"]);
    }

    public function deleteUserCookie()
    {
        setcookie("user-cookie", "", time()-3600, "/");
    }

    public function setUserSession(User $user)
    {
        $_SESSION["user-session"]["username"] = $user->getUsername();
        $_SESSION["user-session"]["password"] = $user->getPassword();
    }

    public function setUserCookie(User $user)
    {
        # TODO: encrypt userInfo to put in a cookie
        $username = $this->encode($user->getUsername());
        $pass = $this->encode($user->getPassword());

        setrawcookie("user-cookie", $username . md5(":") . $pass . "", time() + (86400 * 30), "/");
    }

    public function getLoggedUser()
    {
        $user = false;

        if (isset($_SESSION["user-session"])) {
            $un = $_SESSION["user-session"]["username"];
            $pass = $_SESSION["user-session"]["password"];
        } else if (isset($_COOKIE["user-cookie"])) {
            $cookie = $_COOKIE["user-cookie"];
            #echo $cookie; die();
            $cookie = explode(md5(":"), $cookie);

            $un = $this->decode($cookie[0]);
            $pass = $this->decode($cookie[1]);
        } else {
            # No user is logged
            return false;
        }

        # Now, user might not exist anymore in database.
        # Check user in database

        $user = $this->userDAO->get(array("username" => $un, "password" => $pass));

        if (empty($user)) {
            $this->deleteUserSession();
            $this->deleteUserCookie();
        } else {
            global $date;
            $now = $date->getCurrentDateTime();
            $user->setLastSeen($now);
            $this->updateUser($user);
        }

        return $user;
    }
}
<?php

/**
* Class: Authentication
* 
* Operations related to user authentication, such as Login, Logout, Registration. User session etc.
*
* @package      login-system
* @subpackage   class/auth
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 12, 2019.
* Last Modified: Mar 21, 2019.
*/

class Authentication
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getDatabase()
    {
        return $this->db;
    }

    /**
    * Method: register
    *
    * Creates a new user in the database, returning true if the user doesn't exist, false otherwise.
    *
    * @param User $user.
    * @return bool.
    *
    * Last Modified: Mar 20, 2019.
    */
    public function register($user) {
        # Check if email is already registered
        if ($this->getUserByEmail($user->getEmail()) == null) {
            $this->db->getUserDAO()->createUser($user);
            $this->sendMail($user->getEmail(), $user->getUsername(), $user->getPassword());
            return true;
        }
        else {
            return false;
        }
    }

    /**
    * Method: register
    *
    * Checks email and password in database.
    * If there is an user associated, creates user session.
    * If $keepLogged is true, a cookie is created to store
    * current user authentication data.
    *
    * @param string $email.
    * @param string $password.
    * @param bool $keepLogged.
    * @return bool.
    *
    * Last Modified: Mar 17, 2019.
    */
    public function login($email, $password, bool $keepLogged)
    {
        $loggedUser = $this->checkLoginInDatabase($email, $password);
        
        if ($loggedUser != null) {
            $_SESSION["user-session"]["email"] = $email;
            $_SESSION["user-session"]["password"] = $password;

            if ($keepLogged) {
                # TODO: encrypt userInfo to put in a cookie
                
                $email = $this->encode($email);
                $password = $this->encode($password);

                setrawcookie("user-session", $email . md5(":") . $password . "", time() + (86400 * 30), "/");
            }

            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->deleteUserSession();
        $this->deleteUserCookie();
    }

    public function checkUserSession()
    {
        return $this->getLoggedUser() != null;
    }

    /**
    * Method: getLoggedUser
    *
    * Checks if there is user authentication data in session or cookie.
    * If there is, checks in database if the user exists.
    * Returns the selected user, null otherwise.
    *
    * @return User.
    *
    * Last Modified: Mar 17, 2019.
    */
    public function getLoggedUser()
    {
        if (isset($_SESSION["user-session"])) {
            $email = $_SESSION["user-session"]["email"];
            $pass = $_SESSION["user-session"]["password"];
        }
        else if (isset($_COOKIE["user-session"])) {
            $cookie = $_COOKIE["user-session"];
            #echo $cookie; die();

            $userInfo = explode(md5(":"), $cookie);

            $email = $this->decode($userInfo[0]);
            $pass = $this->decode($userInfo[1]);

            /*echo "<br>";
            var_dump($email);
            echo "<br>";
            var_dump($pass);
            die();*/
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

    public function getUserByEmail($email)
    {
        $c = $this->db->getUserDAO()->getColumnByName("email");
        $c->setValue($email);
        $where = array($c);

        return $this->db->getUserDAO()->select($where);
    }

    public function createPasswordResetRequest($resetEmail, $selector, $token, $expireDate, $url)
    {
        $passwordReset = new PasswordReset(0, $resetEmail, $selector, $token, $expireDate);
        $this->db->getPasswordResetDAO()->createPasswordRecoveryRequest($passwordReset);

        # Send email
        $to = $resetEmail;
        $subject = "Alteração de Senha - Login System";
        $msg = "<p>Abaixo encontra-se o link para alterar sua senha. O link expirará em uma hora.</p>";
        $msg .= "<p>Link para alterar sua senha: <br>";
        $msg .= "<a href='{$url}'>{$url}</a></p>";

        $header = "From: Cubit Software <cubit.open.src@gmail.com>\r\n";
        $header .= "Reply-To: " .$resetEmail. "\r\n";
        $header .= "Content-type: text/html\r\n";

        mail($to, $subject, $msg, $header);
    }

    public function checkValidPasswordResetRequest($selector)
    {
        $passReq = $this->getPasswordResetRequest($selector);
        if ($passReq == null) {
            return false;
        }
        $expires = $passReq->getExpireDate();

        $now = date("U");

        if ($expires <= $now) {
            $email = $passReq->getEmail();
            $this->deletePasswordResetRequest($email);
            return false;
        }
        else {
            return true;
        }
    }

    public function getPasswordResetRequest($selector)
    {
        $c = $this->db->getPasswordResetDAO()->getColumnByName("selector");
        $c->setValue($selector);
        $where = array($c);

        return $this->db->getPasswordResetDAO()->select($where);
    }

    public function deletePasswordResetRequest($resetEmail)
    {
        $this->db->getPasswordResetDAO()->deletePasswordRecoveryRequest($resetEmail);
    }

    public function changePassword($email, $newPassword)
    {
        $email = new Column("email", $email);
        $pass = new Column("password", md5($newPassword));

        $this->db->getUserDAO()->update(array($pass), array($email));
    }

    # Private Methods

    # Returns true if the user exists in the database, false otherwise.
    private function checkLoginInDatabase($email, $password)
    {
        $c1 = $this->db->getUserDAO()->getColumnByName("email");
        $c2 = $this->db->getUserDAO()->getColumnByName("password");
        $c1->setValue($email);
        $c2->setValue(md5($password));
        $where = array($c1, $c2);

        return $this->db->getUserDAO()->select($where);

        #return $this->db->getUserDAO()->select("*", array("email", "password"), array("{$email}", "MD5(" . QT . $password . QT . ")"));
    }

    private function deleteUserSession() {
        $_SESSION["user-session"] = null;
    }

    private function deleteUserCookie() {
        setcookie("user-session", "", time()-3600, "/");
    }

    private function encode($str)
    {
        return urlencode(base64_encode($str));
    }

    private function decode($str)
    {
        return base64_decode(urldecode($str));
    }

    private function sendMail($email, $username, $password)
    {
        #$address = addslashes($email, $username, $password);

        $sendto = $email;
        $subj = "Seus dados de acesso no Blog CMS";
        $body = "Olá " . $username . ". Seja bem-vindo ao Blog CMS. Abaixo estão seus dados de acesso.<br><br>E-mail: " . $email . "<br>Senha: " . $password;
        
        $header = "From: cubit.open.src@gmail.com" . "\r\n" .
                    "Reply-To: " . $email . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();

        mail($sendto, $subj, $body, $header);
    }
}
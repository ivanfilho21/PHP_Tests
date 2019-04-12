<?php
class Authentication extends Model
{
	private $db;
	private $util;

	public function __construct($database, $util)
	{
		$this->db = $database;
		$this->util = $util;
	}

	public function checkUserSession()
    {
        return $this->getLoggedUser() != null;
    }

	public function register($userArray) {
        if ($this->validation($userArray)) {
            #$this->db->getUserDAO()->createUser($user);
            
            #$this->sendMail($user->getEmail(), $user->getUsername(), $user->getPassword());
            echo "Register ok";
            return true;
        }
        else {
            return false;
        }
    }

    public function login($email, $password, bool $keepLogged=false)
    {
        $loggedUser = $this->loginInDatabase($email, $password);
        
        if ($loggedUser !== false) {
            $_SESSION["user-session"]["email"] = $email;
            $_SESSION["user-session"]["password"] = $password;

            if ($keepLogged) {
                # TODO: encrypt userInfo to put in a cookie
                
                $email = $this->encode($email);
                $password = $this->encode($password);

                setrawcookie("user-session", $email . md5(":") . $password, time() + (86400 * 30), "/");
            }
            return true;
        }
        return false;
    }

    # Private methods
    private function validation($userArray)
    {
    	$res = true;

    	# EMAIL
    	$email = $userArray["email"];

    	if (empty($email)) {
    		$this->util->setErrorMessage("email", "E-mail cannot be empty.");
    		$res = false;
    	}
    	
    	# Check if email is already registered
    	if ($this->db->users->getIdByEmail($email) !== false) {
    		$this->util->setErrorMessage("email", "This e-mail already exists.");
    		$res = false;
    	}

    	$regex = "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";

    	if (! preg_match($regex, $email)) {
    		$this->util->setErrorMessage("email", "Enter a valid E_mail.");
    		$res = false;
    	}

    	# PASSWORD
    	$pass = $userArray["password"];
    	$min = 6;

    	if (empty($pass)) {
    		$this->util->setErrorMessage("password", "Password must contain at least {$min} digits.");
    		$res = false;
    	}

    	return $res;
    }


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
        $user = $this->loginInDatabase($email, $pass);

        if ($user !== false) {
            $this->deleteUserSession();
            $this->deleteUserCookie();
        } 

        return $user;
    }

    private function loginInDatabase($email, $password)
    {
    	$userArray = array("email" => $email, "password" => $password);
        return $this->db->users->login($userArray);
    }

    private function encode($str)
    {
        return urlencode(base64_encode($str));
    }

    private function decode($str)
    {
        return base64_decode(urldecode($str));
    }
}
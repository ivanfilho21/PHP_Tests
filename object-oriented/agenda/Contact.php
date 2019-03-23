<?php
define("DB_TYPE", "mysql");
define("DB_NAME", "blog_admin_db");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

class Contact
{
    private $db;

    public function __construct()
    {
        $dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

        $this->db = new PDO($dsn, $dbUser, $dbPass);
        # echo "Connected to Database.";
    }

    public function add($email, $name = "")
    {
        # check if email exists
        # add only if false

        if (! $this->emailExists($email)) {
            $sql = "INSERT INTO contacts (name, email) VALUES (:name, :email)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":name", $name);
            $sql->bindValue(":email", $email);
            $sql->execute();

            return true;
        }
        return false;
    }

    public function getName($email)
    {
        $sql = "SELECT name FROM contacts WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $info = $sql->fetch();

            return $info["name"];
        }
        return "";
    }

    public function getAll()
    {
        $sql = "SELECT * FROM contacts";
        $res = $this->db->query($sql);

        if ($res->rowCount() > 0) {
            return $res->fetchAll();
        }
        return array();
    }

    public function update($newName,$email)
    {
        if ($this->emailExists($email)) {
            $sql = "UPDATE contacts SET name = :name WHERE email = :email";
            $sql = $this->db->dd->prepare($sql);
            $sql->bindValue(":name", $name);
            $sql->bindValue(":email", $email);
            $sql->execute();

            return true;
        }
        return false;
    }

    public function delete($email)
    {
        if ($this->emailExists($email)) {
            $sql = "DELETE FROM contacts WHERE email = :email";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":email", $email);
            $sql->execute();

            return true;
        }
        return false;
    }

    private function emailExists($email)
    {
        $sql = "SELECT * FROM contacts WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        return ($sql->rowCount() > 0);
    }
}
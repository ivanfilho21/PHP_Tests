<?php
class Contact
{
    private $db;
    private $tableName = "`contacts`";

    public function __construct($db)
    {
        $this->db = $db;
        $this->createTable();
    }

    public function createTable()
    {
        $columns = "";
        $columns .= "`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        $columns .= "`name` VARCHAR(100),";
        $columns .= "`email` VARCHAR(100)";
        $sql = "CREATE TABLE IF NOT EXISTS " .$this->tableName ." (" .$columns .")";
        # echo $sql; die;
        $res = $this->db->query($sql);
    }

    public function add($email, $name = "")
    {
        # check if email exists
        # add only if false

        if (! $this->emailExists($email)) {
            $sql = "INSERT INTO " .$this->tableName ." (`name`, `email`) VALUES (:name, :email)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":name", $name);
            $sql->bindValue(":email", $email);
            $sql->execute();

            return true;
        }
        return false;
    }

    public function getInfo($id)
    {
        $sql = "SELECT * FROM " .$this->tableName ." WHERE `id` = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $info = $sql->fetch();
        }
        return array();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " .$this->tableName;
        $res = $this->db->query($sql);

        if ($res->rowCount() > 0) {
            return $res->fetchAll();
        }
        return array();
    }

    public function update($contact, $id)
    {
        $sql = "UPDATE " .$this->tableName ." SET `name` = :name, `email` = :email WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $contact["name"]);
        $sql->bindValue(":email", $contact["email"]);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " .$this->tableName ." WHERE `id` = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

    private function emailExists($email)
    {
        $sql = "SELECT * FROM " .$this->tableName ." WHERE `email` = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        return ($sql->rowCount() > 0);
    }
}
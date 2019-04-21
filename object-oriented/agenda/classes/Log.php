<?php
class Log
{
    private $db;
    private $tableName = "logs";

    public function __construct($db)
    {
        $this->db = $db;
        $this->createTable();
    }

    public function createTable()
    {
        $columns = "";
        $columns .= "`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        $columns .= "`user_ip` VARCHAR(100),";
        $columns .= "`date_action` DATETIME,";
        $columns .= "`action` TEXT";
        $sql = "CREATE TABLE IF NOT EXISTS " .$this->tableName ." (" .$columns .")";
        # echo $sql; die;
        $res = $this->db->query($sql);
    }

    public function register($action)
    {
        $ip = $_SERVER["REMOTE_ADDR"];

        $sql = "INSERT INTO " .$this->tableName ." (`user_ip`, `date_action`, `action`) VALUES (:ip, NOW(), :action)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":ip", $ip);
        $sql->bindValue(":action", $action);
        $sql->execute();
    }
}
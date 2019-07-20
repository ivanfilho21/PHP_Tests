<?php

namespace App\Database;
use \PDO;

/**
* Class: DBA
* 
* Holds all database table objects used in this project.
*
* @package      App
* @subpackage   Database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: July 20, 2019.
* Last Modified: July 20, 2019.
*/

class DBA
{
    private $db = null;
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            return new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->db = $this->getPDOConnection();
    }

    private function getPDOConnection()
    {
        $db = null;

        try {
            $db = new PDO("mysql:dbname=" .DB_NAME .";host=" .DB_HOST, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die($e->getMessage());
        }

        return $db;
    }
}
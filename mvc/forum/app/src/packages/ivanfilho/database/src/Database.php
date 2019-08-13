<?php

namespace IvanFilho\Database;

use \PDO;

/**
* Class: Database
* 
* Holds the database connection PDO object. There can be only one instance of this class.
*
* @package      IvanFilho
* @subpackage   Database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Jun 4, 2019.
*/

class Database
{
	public static $instance = null;

	public static function getInstance()
	{
		if (self::$instance === null) {
			return new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		try {
			$this->db = new PDO("mysql:dbname=" .DB_NAME .";host=" .DB_HOST, DB_USER, DB_PASS);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}
}
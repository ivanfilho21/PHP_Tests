<?php

class Users extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "users";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("name", VARCHAR, 100, false);
        $this->columns[] = new Column("email", VARCHAR, 100, false);
        $this->columns[] = new Column("password", VARCHAR, 32, false);
        $this->columns[] = new Column("phone", VARCHAR, 30);
	}

	public function register($userArray)
	{
		$id = $this->getIdByEmail($userArray["email"]);
		
		# User exists, return.
		if ($id !== false) {
			return false;	
		}

		parent::insert($userArray);
		return true;
	}

	public function login($userArray)
	{
		# select
		$select[] = DatabaseUtils::createSelection($this, "id");

		# condition
		$where[] = DatabaseUtils::createCondition($this, "email", $userArray["email"]);
		$where[] = DatabaseUtils::createCondition($this, "password", $userArray["password"]);

		$user = parent::selectOne(array(), $where);
		return ($user !== false) ? $user["id"] : false;
	}

	public function getAll()
	{
		return parent::selectAll(array(), array(), true);
	}

	private function getIdByEmail($email)
	{
		# select
		$select[] = DatabaseUtils::createSelection($this, "id");

		# condition
		$where[] = DatabaseUtils::createCondition($this, "email", $email);

		$user = parent::selectOne(array(), $where);
		return ($user !== false) ? $user["id"] : false;
	}
}
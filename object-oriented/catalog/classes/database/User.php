<?php

class User extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "users";
        $this->columns[] = new Column("id", "", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("email", "", VARCHAR, 100, false);
        $this->columns[] = new Column("password", "", VARCHAR, 32, false);
        $this->columns[] = new Column("phone", "", VARCHAR, 30, true);
	}

	public function register($user)
	{
		$id = $this->getIdByEmail($user["email"]);
	}

	private function getIdByEmail($email)
	{
		$s = parent::findColumn("id");
		echo $s->getName(); die();

		$select = array();
		$where = array();

		parent::select($select, $where);
	}

	public function createTable()
	{
		echo "TODO: create table.";
	}

    public function dropTable()
    {

    }
}
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
		#echo $id; die();
		
		# User doesn't exist.
		if ($id == false) {
			parent::insert($userArray);
			return true;
		}
		return false;
	}

	public function login($userArray)
	{
		return $this->getIdByEmail($userArray["email"]);
	}

	private function getIdByEmail($email)
	{
		$s = parent::findColumn("id");
		$c = parent::findColumn("email");

		$c->setValue($email);

		$select = array($s);
		$where = array($c);

		$id = parent::select($select, $where);

		if ($id != false) {
            return $id["id"];
		}
		return false;
	}

	# Override
	public function createTable()
	{
		parent::create();
	}

	# Override
    public function dropTable()
    {
    	parent::drop();
    }
}
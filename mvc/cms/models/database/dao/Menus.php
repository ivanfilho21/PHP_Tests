<?php
class Menus extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "menu";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("name", VARCHAR, 100, false);
        $this->columns[] = new Column("url", VARCHAR, 100, false);
	}

	public function getById($id)
	{
		$where[] = DatabaseUtils::createCondition($this, "id", $id);
		return parent::selectOne(array(), $where);
	}

	public function getAll()
	{
		return parent::selectAll(array(), array(), true);
	}

	public function edit($array)
	{
		$where[] = DatabaseUtils::createCondition($this, "id", $array["id"]);
		parent::update($array, $where);
	}

	public function delete($id)
	{
		$where[] = DatabaseUtils::createCondition($this, "id", $id);
		parent::delete($where);
	}
}
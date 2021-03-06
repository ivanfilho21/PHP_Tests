<?php
class Categories extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);
		$this->tableName = "categories";
		$this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("name", VARCHAR, 100, false);
	}

	public function getAll()
	{
		return parent::selectAll();
	}
}
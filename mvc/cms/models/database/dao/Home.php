<?php
class Home extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "home";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("title", VARCHAR, 100, false);
        $this->columns[] = new Column("banner", VARCHAR, 100);
        $this->columns[] = new Column("welcome", VARCHAR, 100);
        $this->columns[] = new Column("body", VARCHAR, 100);
	}

	public function edit($array)
	{
		$where[] = DatabaseUtils::createCondition($this, "id", $array["id"]);
		parent::update($array, $where);
	}

	public function get($columnName="")
	{
		# select
		$select = array();

		if (! empty($columnName))
			$select[] = DatabaseUtils::createSelection($this, $columnName);

		$config = parent::selectOne($select);
		
		if (! empty($columnName))
			return ($config !== false) ? $config[$columnName] : false;

		return $config;
	}

	public function getAll()
	{
		return parent::selectAll(array(), array(), true);
	}
}
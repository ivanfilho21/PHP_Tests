<?php
class SiteConfiguration extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "site_configuration";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("title", VARCHAR, 100, false);
        $this->columns[] = new Column("color", VARCHAR, 100, false);
        $this->columns[] = new Column("template", VARCHAR, 100, false);
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
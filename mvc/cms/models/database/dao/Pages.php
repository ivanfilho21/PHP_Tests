<?php
class Pages extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "pages";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("url", VARCHAR, 50, false);
        $this->columns[] = new Column("title", VARCHAR, 100, false);
        $this->columns[] = new Column("body", VARCHAR, 100, false);
	}

	public function insert($array, $database="")
	{
		parent::insert($array);

		$menu = array("name" => $array["title"], "url" => $array["url"]);
		$database->menus->insert($menu);
	}

	public function getById($id)
	{
		$select = array();
		$where[] = DatabaseUtils::createCondition($this, "id", $id);

		return parent::selectOne($select, $where);
	}


	public function getByUrl($url)
	{
		$select = array();
		$where[] = DatabaseUtils::createCondition($this, "url", $url);

		return parent::selectOne($select, $where);
	}

	public function getAll()
	{
		return parent::selectAll(array(), array(), true);
	}

	public function edit($array, $database="")
	{
		$where[] = DatabaseUtils::createCondition($this, "id", $array["id"]);
		parent::update($array, $where);
	}
	
	public function delete($id, $database="")
	{
		$array = $this->getById($id);

		$where[] = DatabaseUtils::createCondition($this, "id", $id);
		parent::delete($where);

		$database->menus->deleteByUrl($array["url"]);
	}
}
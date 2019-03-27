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

	public function addCategory($categoryArray)
	{
		parent::insert($categoryArray);
	}

	public function getAll()
	{
		$list = parent::select();
		echo var_dump($list);

		foreach ($list as $key => $value) {
			#echo "[$key] = $value<br>";
		}

		return $list;
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
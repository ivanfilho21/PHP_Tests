<?php

class Announcements extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "announcements";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("userId", INT, 0, false);
        $this->columns[] = new Column("categoryId", INT, 0, false);
        $this->columns[] = new Column("title", VARCHAR, 100);
        $this->columns[] = new Column("description", VARCHAR, 100);
        $this->columns[] = new Column("price", FLOAT, -1);
        $this->columns[] = new Column("condition", INT);
	}

	public function getUserAnnouncements($userId)
	{
		$c = parent::findColumn("userId");
		$c->setValue($userId);

		$as = new Column("url", VARCHAR, 200); #todo Database->get...

		$ac = new Column("id", INT); # get from table instead

		$select = "*";
		$where = array($c);
		$additionalColumns = array($as);
		$additionalTable = "announcement_images"; #todo
		$additionalWhere = array($ac);
		$limit = 1;

		$res = parent::select($select, $where, $additionalColumns, $additionalTable, $additionalWhere, $limit);
		if ($res) {
			return $res;
		}
		return array();
	}

	public function addAnnouncement($announcementArray)
	{
		parent::insert($announcementArray);
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
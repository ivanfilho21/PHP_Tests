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
        $this->columns[] = new Column("condition", INT);
        $this->columns[] = new Column("price", FLOAT, -1);
        $this->columns[] = new Column("description", VARCHAR, 100);
	}

	public function getUserAnnouncements($database, $userId)
	{
		# condition
		$c = parent::findColumn("userId");
		$c->setValue($userId);

		# additional selection
		$as = $database->getAnnouncementImagesTable()->findColumn("url"); #new Column("url", VARCHAR, 200); #todo Database->get...
		# additional condition
		$ac = $database->getAnnouncementImagesTable()->findColumn("announcementId");#new Column("id", INT); # get from table instead

		#echo $as->getName(); die();
		#echo $ac->getName(); die();

		$ac->setValue("id");

		$select = array();
		$where = array($c);
		$additionalColumns = array($as);
		$additionalTable = $database->getAnnouncementImagesTable()->getTableName();#"announcement_images"; #todo
		$additionalWhere = array($ac);
		$limit = 1;

		$res = parent::select($select, $where, $additionalColumns, $additionalTable, $additionalWhere, $limit, true);
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
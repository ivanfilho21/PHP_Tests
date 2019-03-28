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
		$as = $database->getAnnouncementImagesTable()->findColumn("url");
		# additional condition
		$ac = $database->getAnnouncementImagesTable()->findColumn("announcementId");
		$ac->setValue("id");

		$select = array();
		$where = array($c);
		$additionalColumns = array($as);
		$additionalTable = $database->getAnnouncementImagesTable()->getTableName();#"announcement_images"; #todo
		$additionalWhere = array($ac);
		$limit = 1;

		$res = parent::select($select, $where, $additionalColumns, $additionalTable, $additionalWhere, $limit);
		return ($res) ? $res : array();
	}

	public function getUserAnnouncement($database, $id, $userId)
	{
		# condition
		$c1 = parent::findColumn("id");
		$c2 = parent::findColumn("userId");
		$c1->setValue($id);
		$c2->setValue($userId);

		# additional selection
		$as = $database->getAnnouncementImagesTable()->findColumn("url");
		# additional condition
		$ac = $database->getAnnouncementImagesTable()->findColumn("announcementId");
		$ac->setValue("id");

		$select = array();
		$where = array($c1, $c2);
		$additionalColumns = array($as);
		$additionalTable = $database->getAnnouncementImagesTable()->getTableName();#"announcement_images"; #todo
		$additionalWhere = array($ac);
		$limit = 1;

		$res = parent::select($select, $where, $additionalColumns, $additionalTable, $additionalWhere, $limit, false);
		return ($res) ? $res : array();
	}

	public function addAnnouncement($announcementArray)
	{
		parent::insert($announcementArray);
	}

	public function editAnnouncement($announcementArray)
	{
		parent::update($announcementArray);
	}

	public function deleteAnnouncement($id)
	{
		$c = parent::findColumn("id");
		$c->setValue($id);

		$where = array($c);
		parent::delete($where);
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
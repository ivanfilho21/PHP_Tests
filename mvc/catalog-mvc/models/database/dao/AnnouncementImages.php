<?php

class AnnouncementImages extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "announcement_images";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY"); # TODO: remove Zero and fix problems...
        $this->columns[] = new Column("announcementId", INT, false);
        $this->columns[] = new Column("url", VARCHAR, 200);
    }

    public function get($id)
    {
        $select = array();
        $where[] = DatabaseUtils::createCondition($this, "id", $id);

        return parent::selectOne($select, $where);
    }

    public function getAll($announcementId)
    {
        # select
        $select = array();

        # condition
        $where[] = DatabaseUtils::createCondition($this, "announcementId", $announcementId);
        $asList = true;

        return parent::selectAll($select, $where, $asList);
    }
    
    public function delete($id)
    {
        $where[] = DatabaseUtils::createCondition($this, "id", $id);
        parent::delete($where);
    }
}
<?php

class AnnouncementImages extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "announcement_images";
        $this->columns[] = new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("announcementId", INT, false);
        $this->columns[] = new Column("url", VARCHAR, 200);
    }

    public function get($id)
    {
        $select = array();
        $where[] = DatabaseUtils::createCondition($this, "id", $id);

        return parent::select($select, $where);
    }

    public function getAll($announcementId)
    {
        # select
        $select = array();

        # condition
        $where[] = DatabaseUtils::createCondition($this, "announcementId", $announcementId);

        return parent::select($select, $where, array(), "", array(), "", true);
    }

    # Override
    public function findColumn($name)
    {
        return parent::findColumn($name);
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

    # Override
    public function insert($array)
    {
        parent::insert($array);
    }
    
    # Override
    public function delete($id)
    {
        $where[] = DatabaseUtils::createCondition($this, "id", $id);
        parent::delete($where);
    }
}
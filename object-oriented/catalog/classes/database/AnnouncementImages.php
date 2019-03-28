<?php

class AnnouncementImages extends DAO
{
	public function __construct($pdo)
	{
		parent::__construct($pdo);

		$this->tableName = "announcement_images";
        $this->columns[] = new Column("id", INT, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("announcementId", INT, false);
        $this->columns[] = new Column("url", VARCHAR, 200);
    }

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
}
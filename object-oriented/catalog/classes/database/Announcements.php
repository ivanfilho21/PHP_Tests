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
		$additionalSelectColumn = "url";

		$returnAsList = true;

		$res = parent::select($select, $where, $additionalColumns, $additionalTable, $additionalWhere, $limit, $additionalSelectColumn, $returnAsList);

		return ($res) ? $res : array();
	}

	public function getUserAnnouncement($database, $id, $userId)
	{
		# condition
		$c1 = parent::findColumn("id");
		$c2 = parent::findColumn("userId");
		$c1->setValue($id);
		$c2->setValue($userId);

		$select = array();
		$where = array($c1, $c2);

		$announcement = parent::select($select, $where);

		# get pictures
		$pictures = $database->getAnnouncementImagesTable()->getAll($announcement["id"]);

		$announcement["pictures"] = $pictures;

		return ($announcement) ? $announcement : array();
	}

	public function addAnnouncement($database, $announcementArray, $pictures=array())
	{
		parent::insert($announcementArray);
		$announcementId = $this->db->lastInsertId();

		$supportedTypes = array("image/jpeg", "image/png");

		for ($i = 0; $i < count($pictures["tmp_name"]); $i++) {
			$type = $pictures["type"][$i];

			if (in_array($type, $supportedTypes)) {
				$tmpName = md5(time() .rand(0, 9999)) .".jpg";
				$imagePath = ANNOUNCEMENT_PICTURES_DIR ."/" .$tmpName;
				move_uploaded_file($pictures["tmp_name"][$i], $imagePath);

				# resize and save image
				$this->saveResizedImage($type, $imagePath);

				$pictureArray = array("announcementId" => $announcementId, "url" => $tmpName);
				$database->getAnnouncementImagesTable()->insert($pictureArray);
			}
		}
	}

	private function saveResizedImage($type, $imagePath)
	{
		list($srcWidth, $srcHeight) = getimagesize($imagePath);
		$ratio = $srcWidth / $srcHeight;
		$width = 500;
		$height = 500;

		if ($width/$height > $ratio) {
			$width = $height * $ratio;
		}
		else {
			$height = $width * $ratio;
		}

		$img = imagecreatetruecolor($width, $height);
		
		
		switch ($type) {
			case "image/jpeg":
				$src = imagecreatefromjpeg($imagePath);
				break;
			case "image/png":
				$src = imagecreatefrompng($imagePath);
				break;
			default:
				$src = "";
				break;
		}

		imagecopyresampled($img, $src, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
		imagejpeg($img, $imagePath, 80);
	}

	public function editAnnouncement($announcementArray)
	{
		$c = $this->findColumn("id");
		$c->setValue($announcementArray["id"]);
		$where = array($c);
		parent::update($announcementArray, $where);
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
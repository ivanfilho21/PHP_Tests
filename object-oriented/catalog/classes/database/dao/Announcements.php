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

	public function insert($announcementArray, $pictureArray=array(), $database="")
	{
		parent::insert($announcementArray);
		$announcementId = $this->db->lastInsertId();

		$this->savePictures($database, $announcementId, $pictureArray);
	}

	public function update($announcementArray, $pictureArray=array(), $database="")
	{
		# condition
		$where[] = DatabaseUtils::createCondition($this, "id", $announcementArray["id"]);
		parent::update($announcementArray, $where);

		$this->savePictures($database, $announcementArray["id"], $pictureArray);
	}

	public function getAll($userId, $database="")
	{
		# select
		$select = array();
		# condition
		$where[] = DatabaseUtils::createCondition($this, "userId", $userId);

		$announcementImagesTable = $database->getAnnouncementImagesTable();
		$additionalTable = $announcementImagesTable->getTableName();
		$additionalSelect[] = DatabaseUtils::createSelection($announcementImagesTable, "url");
		$additionalWhere[] = DatabaseUtils::createCondition($announcementImagesTable, "announcementId", "id");
		$limit = "";
		$additionalLimit = 1;
		$asList = true;

		$res = parent::selectWithAdditionalColumn($select, $where, $limit, $additionalSelect, $additionalWhere, $additionalTable, $additionalLimit, $asList);

		return ($res) ? $res : array();
	}

	public function get($id, $userId, $database)
	{
		# select
		$select = array();

		# condition
		$where[] = DatabaseUtils::createCondition($this, "id", $id);
		$where[] = DatabaseUtils::createCondition($this, "userId", $userId);

		$announcement = parent::selectOne($select, $where);

		# get pictures
		$pictures = $database->getAnnouncementImagesTable()->getAll($announcement["id"]);

		if ($announcement !== false) {
			$announcement["pictures"] = ($pictures !== false) ? $pictures : array();
			return $announcement;
		}
		return array();
	}

	public function delete($id)
	{
		$where[] = DatabaseUtils::createCondition($this, "id", $id);
		parent::delete($where);
	}

	# Private methods

	private function savePictures($database, $announcementId, $pictures)
	{
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
}
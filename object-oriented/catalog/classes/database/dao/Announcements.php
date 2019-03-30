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

	public function getLatest($database, $page=1, $limit=5)
	{
		# select
		$select = array();

		# condition
		$where = array();

		# additionalSelections
		$additional = array();

		$table1 = array("name" => "", "select" => array(), "where"  => array(), "as" => "", "limit" => "");
		$announcementImagesTable = $database->getAnnouncementImagesTable();

		$table1["name"] = $announcementImagesTable->getTableName();
		$table1["select"][] = DatabaseUtils::createSelection($announcementImagesTable, "url");
		$table1["where"][] = DatabaseUtils::createCondition($announcementImagesTable, "announcementId", "id");
		$table1["as"] = "url";
		$table1["limit"] = 1;

		$table2 = array("name" => "", "select" => array(), "where"  => array(), "limit" => "");
		$categoriesTable = $database->getCategoriesTable();

		$table2["name"] = $categoriesTable->getTableName();
		$table2["select"][] = DatabaseUtils::createSelection($categoriesTable, "name");
		$table2["where"][] = DatabaseUtils::createCondition($categoriesTable, "id", "categoryId");
		$table2["as"] = "categoryName";
		$table2["limit"] = 1;

		$additional[] = $table1;
		$additional[] = $table2;

		# order
		$order = array("column" => parent::findColumn("id"), "criteria" => "DESC");

		# result as list, even if only one is queried
		$asList = true;

		# Id starts from
		$startPoint = ($page - 1) * $limit;
		$limitTxt = $startPoint .", " .$limit;

		$res = parent::selectWithAdditionalColumn($select, $where, $limitTxt, $additional, $order, $asList);
		return ($res) ? $res : array();
	}

	public function getAll($userId="", $database="")
	{
		# select
		$select = array();

		# condition
		$where = array();
		if (! empty($userId))
			$where[] = DatabaseUtils::createCondition($this, "userId", $userId);

		# additionalSelections
		$additional = array();

		if (! empty($database)) {
			$table1 = array("name" => "", "select" => array(), "where"  => array(), "as" => "", "limit" => "");
			$announcementImagesTable = $database->getAnnouncementImagesTable();

			$table1["name"] = $announcementImagesTable->getTableName();
			$table1["select"][] = DatabaseUtils::createSelection($announcementImagesTable, "url");
			$table1["where"][] = DatabaseUtils::createCondition($announcementImagesTable, "announcementId", "id");
			$table1["as"] = "url";
			$table1["limit"] = 1;

			$additional[] = $table1;
		}

		# query limit
		$limit = "";

		# order
		#$order = array();
		$order = array("column" => parent::findColumn("id"), "criteria" => "DESC");

		# result as list
		$asList = true;

		$res = parent::selectWithAdditionalColumn($select, $where, $limit, $additional, $order, $asList);
		return ($res) ? $res : array();
	}

	public function get($id, $userId, $database)
	{
		# select
		$select = array();

		# condition
		$where[] = DatabaseUtils::createCondition($this, "id", $id);
		if (! empty($userId))
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
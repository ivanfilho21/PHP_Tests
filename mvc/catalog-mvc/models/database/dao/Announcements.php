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

	public function search($name, $database, $page=1, $filter=array(), $maxPerPage=0)
	{
		$sp = ($page - 1) * $maxPerPage;

		$db = $this->db;

		$sql = "SELECT *, (SELECT `announcement_images`.`url` FROM `announcement_images` WHERE `announcement_images`.`announcementId` = `announcements`.`id` LIMIT 1) AS `url`, (SELECT `categories`.`name` FROM `categories` WHERE `categories`.`id` = `announcements`.`categoryId` LIMIT 1) AS `categoryName` FROM `" .$this->tableName ."` WHERE `title` LIKE '%" .$name ."%' LIMIT " .$sp .", " .$maxPerPage;

		$res = $db->query($sql);
		if ($res->rowCount() == 1) {
			$list[] = $res->fetch();
            return $list;
		} elseif ($res->rowCount() > 1) {
			return $res->fetchAll();
		} else {
			return array();
		}

	}

	public function getLatest($database, $page=1, $filter=array(), $maxPerPage=0)
	{
		# select
		$select = array();

		# condition
		$where = array();

		$where = $this->getWhereFromFilter($where, $filter);

		/*if (count($filter) > 0) {
			if (! empty($filter["category"])) {
				#$select[] = DatabaseUtils::createSelection($database->getCategoriesTable(), "id");
				$where[] = DatabaseUtils::createCondition($this, "categoryId", $filter["category"]);
			}
			if (! empty($filter["price-range"])) {
				$priceRange = $filter["price-range"];
			}
			if (! empty($filter["condition"])) {
				#$select[] = DatabaseUtils::createSelection($this, "condition");
				$where[] = DatabaseUtils::createCondition($this, "condition", $filter["condition"] -1);
			}
		}*/

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
		$order = array();
		$order[] = DatabaseUtils::createOrder($this, "id", "DESC");

		if (isset($priceRange)) {
		$criteria = ($priceRange == 1) ? "ASC" : "DESC";
			if (! empty($criteria))
				$order[] = DatabaseUtils::createOrder($this, "price", $criteria);
		}

		# result as list, even if only one is queried
		$asList = true;

		$limit = $maxPerPage;

		if (! empty($limit)) {
			# Id starts from
			$startPoint = ($page - 1) * $limit;
			$limitTxt = ($startPoint >= 0) ? $startPoint .", " .$limit : "";
		}
		else
			$limitTxt = "";

		$res = parent::selectWithAdditionalColumn($select, $where, $limitTxt, $additional, $order, $asList);
		return ($res) ? $res : array();
	}

	public function getAll($userId="", $database="", $filter=array())
	{
		# select
		$select = array();

		# condition
		$where = array();
		if (! empty($userId))
			$where[] = DatabaseUtils::createCondition($this, "userId", $userId);

		$where = $this->getWhereFromFilter($where, $filter);

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
		$order = array();
		$order[] = DatabaseUtils::createOrder($this, "id", "DESC");

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

	private function getWhereFromFilter($where, $filter)
	{
		if (count($filter) > 0) {
			if (! empty($filter["category"])) {
				#$select[] = DatabaseUtils::createSelection($database->getCategoriesTable(), "id");
				$where[] = DatabaseUtils::createCondition($this, "categoryId", $filter["category"]);
			}
			if (! empty($filter["price-range"])) {
				$priceRange = $filter["price-range"];
			}
			if (! empty($filter["condition"])) {
				#$select[] = DatabaseUtils::createSelection($this, "condition");
				$where[] = DatabaseUtils::createCondition($this, "condition", $filter["condition"] -1);
			}
		}

		return $where;
	}

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

		if (($width/$height) > $ratio) {
			$width = $height * $ratio;
		}
		else {
			$height = $width / $ratio;
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
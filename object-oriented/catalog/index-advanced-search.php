<?php
$util = new Util();

$filter = getEmptyFilterArray();

if ($util->checkMethod("GET")) {
	if (isset($_GET["advanced-search"])) {
		$filter = (isset($_GET["filter"])) ? $_GET["filter"] : getEmptyFilterArray();
		#$filter = $_GET["filter"];

		if (count($filter) > 0) {
			#var_dump($filter["category"]);
		}
	}
}

function getEmptyFilterArray()
{
	return array("category" => "", "price-range" => "", "condition" => "");
}

function checkIdInCategoryFilter($id)
{
	global $filter;

	if (isset($filter["category"])) {
		foreach ($filter["category"] as $key => $category) {
			if ($category == $id) return true;
		}
	}
	

	return false;
}
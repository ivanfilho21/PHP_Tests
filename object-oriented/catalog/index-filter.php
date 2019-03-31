<?php
$util = new Util();

$filter = getEmptyFilterArray();

if ($util->checkMethod("GET")) {
	if (isset($_GET["filter-submit"])) {
		$filter = (isset($_GET["filter"])) ? $_GET["filter"] : getEmptyFilterArray();

		if (! is_array($filter)) {
			$filter = getEmptyFilterArray();
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
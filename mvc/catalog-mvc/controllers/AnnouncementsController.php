<?php
class AnnouncementsController extends Controller
{
	public function __construct()
	{
		$this->title = "";
		$this->viewName = "announcements";
		$this->viewData = array();
	}

	public function index()
	{
		checkUserPermissionToPage();
		global $database;

		$this->title = "My Announcements";
		$this->viewData["database"] = $database;

		$this->loadView("my-announcements");
	}

	public function view($id)
	{
		if (empty($id)) {
			$this->redirectToIndex();
		}
		global $database;
		require "scripts/announcements/view.php";

		$this->viewData["title"] = $title;
		$this->viewData["price"] = $price;
		$this->viewData["firstPictureUrl"] = $firstPictureUrl;
		$this->viewData["description"] = $description;

		$this->title = $title;

		$this->loadView("announcement-view");
	}

	public function create()
	{
		checkUserPermissionToPage();
		global $database;
		require "scripts/announcements/create-edit.php";

		$this->title = "Create";
		$this->viewData["util"] = $util;
		$this->viewData["categories"] = $categories;
		$this->viewData["announcements"] = $announcements;
		$this->viewData["announcement"] = $announcement;
		$this->viewData["created"] = $created;
		$this->viewData["createMode"] = $createMode;

		$this->viewData["id"] = $id;
		$this->viewData["userId"] = $userId;
		$this->viewData["categoryId"] = $categoryId;
		$this->viewData["title"] = $title;
		$this->viewData["condition"] = $condition;
		$this->viewData["price"] = $price;
		$this->viewData["description"] = $description;

		$this->loadView("announcement");
	}

	public function edit($id)
	{
		if (empty($id)) {
			$this->redirectToIndex();
		}

		checkUserPermissionToPage();
		global $database;
		require "scripts/announcements/create-edit.php";

		$this->title = "Edit";
		$this->viewData["util"] = $util;
		$this->viewData["categories"] = $categories;
		$this->viewData["announcements"] = $announcements;
		$this->viewData["announcement"] = $announcement;
		$this->viewData["created"] = $created;
		$this->viewData["createMode"] = $createMode;

		$this->viewData["id"] = $id;
		$this->viewData["userId"] = $userId;
		$this->viewData["categoryId"] = $categoryId;
		$this->viewData["title"] = $title;
		$this->viewData["condition"] = $condition;
		$this->viewData["price"] = $price;
		$this->viewData["description"] = $description;
		$this->viewData["pictures"] = $pictures;

		$this->loadView("announcement");
	}

	public function delete($id)
	{
		if (empty($id)) {
			$this->redirectToIndex();
		}
		global $database;
		require "scripts/announcements/delete.php";
	}

	public function deletePicture($imgId)
	{
		if (empty($id)) {
			$this->redirectToIndex();
		}
		global $database;
		$id = $imgId;
		require "scripts/announcements/delete-picture.php";
	}

	private function redirectToIndex()
	{
		header("Location: " .BASE_URL);
		exit();
	}
}
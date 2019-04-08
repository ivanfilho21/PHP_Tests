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
		global $database;
		require "scripts/announcement/view.php";
		$this->viewData["title"] = $title;
		$this->viewData["price"] = $price;
		$this->viewData["firstPictureUrl"] = $firstPictureUrl;
		$this->viewData["description"] = $description;

		$this->title = $title;

		$this->loadView("announcement-view");
	}

	public function create()
	{
		#
	}

	public function edit()
	{
		#
	}

	public function delete()
	{
		#
	}
}
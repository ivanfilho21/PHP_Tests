<?php
class AnnouncementController extends Controller
{
	public function __construct()
	{
		$this->title = "";
		$this->viewName = "announcement";
		$this->viewData = array();
	}

	public function index()
	{
		$this->loadView();
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
}
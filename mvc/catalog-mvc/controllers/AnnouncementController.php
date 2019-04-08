<?php
class AnnouncementController extends Controller
{
	public function index()
	{
		$this->loadView();
	}

	public function view($id)
	{
		global $database;
		require "scripts/announcement/announcement-view-script.php";
		$this->viewData["title"] = $title;
		$this->viewData["price"] = $price;
		$this->viewData["firstPictureUrl"] = $firstPictureUrl;
		$this->viewData["description"] = $description;

		$this->loadView("announcement-view");
	}
}
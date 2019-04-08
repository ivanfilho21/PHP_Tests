<?php
class HomeController extends Controller
{
	public function __construct()
	{
		$this->title = "Home";
		$this->viewName = "home";
		$this->viewData = array(); 
	}

	public function index()
	{
		global $database;
		require "./scripts/" .$this->viewName ."/" .$this->viewName ."-filter.php";
		require "./scripts/" .$this->viewName ."/" .$this->viewName ."-script.php";

		$this->viewData = array(
			"filter" => $filter,
			"categories" => $categories,
			"totalUsers" => $totalUsers,
			"maxPages" => $maxPages,
			"currentPage" => $currentPage,
			"latestAnnouncements" => $latestAnnouncements,
			"totalAnnouncements" => $totalAnnouncements
		);

		$this->loadView();
	}
}
<?php
class PagesController extends Controller
{
	public function __construct($database)
	{
		parent::__construct($database, "Pages");
	}

	# url is the page to load from database
	public function index($url="")
	{
		$data = $this->database->pages->getByUrl($url);
		if ($data !== false) {
			$this->title = $data["title"];
			$this->loadView("page", true, $data);
		}
		else {
			$this->title = "Page Not Found";
			$this->loadView("404", false);
		}
	}
}
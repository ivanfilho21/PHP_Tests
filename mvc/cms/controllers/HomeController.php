<?php
class HomeController extends Controller
{
	public function __construct($database)
	{
		parent::__construct($database, "Home");
	}

	public function index()
	{
		$data["home"] = $this->database->home->get();
		$this->loadView("home", $data);
	}
}
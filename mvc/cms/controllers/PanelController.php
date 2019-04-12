<?php
class PanelController extends Controller
{
	public function __construct($database)
	{
		parent::__construct($database, "Main Panel");
	}

	public function index()
	{
		$this->loadView("panel/home", array(), "panel/panel");
	}
}
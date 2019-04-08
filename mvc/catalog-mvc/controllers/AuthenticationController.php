<?php
class AuthenticationController extends Controller
{
	
	public function index()
	{
		$this->login();
	}

	public function login()
	{
		global $database;
		require "scripts/auth/authentication.php";

		$this->title = "Login";
		$this->viewData["util"] = $util;
		$this->viewData["email"] = $email;
		$this->loadView("login");
	}

	public function logout()
	{
		require "scripts/auth/logout.php";
	}

	public function register()
	{
		global $database;
		require "scripts/auth/authentication.php";

		$this->title = "Register";
		$this->viewData["util"] = $util;
		$this->viewData["finished"] = $finished;
		$this->viewData["name"] = $name;
		$this->viewData["email"] = $email;
		$this->viewData["phone"] = $phone;
		$this->loadView("register");
	}
}
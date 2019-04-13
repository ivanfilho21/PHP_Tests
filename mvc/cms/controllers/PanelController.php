<?php
class PanelController extends Controller
{
	private $auth;
	private $util;

	public function __construct($database)
	{
		parent::__construct($database, "Main Panel");
		$this->util = new Util();
		$this->auth = new Authentication($this->database, $this->util);
		
	}

	public function index()
	{
		if (! $this->auth->checkUserSession()) {
			header("Location: " .BASE_URL ."panel/login");
			exit();
		}
		$this->loadView("panel/home", array(), "panel/panel");
	}

	public function login()
	{
		$data = array();
		$data["loginMode"] = true;
		$data["registerFinished"] = false;

		if ($this->util->checkMethod("POST") && isset($_POST["login"])) {
			$email = (! empty($_POST["email"])) ? $this->util->formatHTMLInput($_POST["email"]) : "";
			$pass = (! empty($_POST["password"])) ? $this->util->formatHTMLInput($_POST["password"]) : "";
			$keep = (! empty($_POST["keep-session"])) ? true : false;
			
			if ($this->auth->login($email, $pass, true)) {
				header("Location: " .BASE_URL ."panel");
				exit();
			} else {
				$this->util->setErrorMessage("login", "Failed to login. Check your e-mail or password and try again.");
			}
		}

		$data["error"] = $this->util->getErrorMessageArray();
		$this->loadView("authentication", $data, "panel/panel");
	}

	public function register()
	{
		$data = array();
		$data["loginMode"] = false;
		$data["registerFinished"] = false;

		if ($this->util->checkMethod("POST") && isset($_POST["register"])) {
			$name = (! empty($_POST["name"])) ? $this->util->formatHTMLInput($_POST["name"]) : "";
			$email = (! empty($_POST["email"])) ? $this->util->formatHTMLInput($_POST["email"]) : "";
			$pass = (! empty($_POST["password"])) ? $this->util->formatHTMLInput($_POST["password"]) : "";

			if ($this->auth->register(array("name" => $name, "email" => $email, "password" => $pass))) {
				$data["registerFinished"] = true;
			}
		}

		$data["error"] = $this->util->getErrorMessageArray();
		$this->loadview("authentication", $data, "panel/panel");
	}
}
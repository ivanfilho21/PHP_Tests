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
			exit;
		}
		$this->loadView("panel/home", array(), "panel/panel");
	}

	public function login()
	{
		$data = array();
		$data["loginMode"] = true;

		if ($this->util->checkMethod("POST") && isset($_POST["login"])) {
			$email = (! empty($_POST["email"])) ? $this->util->formatHTMLInput($_POST["email"]) : "";
			$pass = (! empty($_POST["password"])) ? $this->util->formatHTMLInput($_POST["password"]) : "";
			
			if ($this->auth->login($email, $pass, true)) {
				echo "User is logged"; die();
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

		if ($this->util->checkMethod("POST") && isset($_POST["register"])) {
			$email = (! empty($_POST["email"])) ? $this->util->formatHTMLInput($_POST["email"]) : "";
			$pass = (! empty($_POST["password"])) ? $this->util->formatHTMLInput($_POST["password"]) : "";

			if ($this->auth->register(array("email" => $email, "password" => $pass))) {

			}
		}

		$data["error"] = $this->util->getErrorMessageArray();
		$this->loadview("authentication", $data, "panel/panel");
	}
}
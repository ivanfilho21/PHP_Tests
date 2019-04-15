<?php
class PanelController extends Controller
{
	private $auth;
	private $util;
	private $subdir = "panel/";
	private $template = "";

	public function __construct($database)
	{
		parent::__construct($database, "Main Panel");
		$this->util = new Util();
		$this->auth = new Authentication($this->database, $this->util);
		$this->template = $this->subdir ."panel";
	}

	public function index()
	{
		if (! $this->auth->checkUserSession()) {
			header("Location: " .BASE_URL ."panel/login");
			exit();
		}
		$this->loadView($this->subdir ."home", array(), $this->template);
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
				#header("Location: " .BASE_URL ."panel");
				redirect($this->subdir);
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

	public function pages()
	{
		$data["pages"] = $this->database->pages->getAll();
		$data["columns"] = $this->database->pages->getColumns();
		$this->loadview($this->subdir ."pages", $data, $this->template);
	}

	public function menus()
	{
		$data["menus"] = $this->database->menus->getAll();
		$data["columns"] = $this->database->menus->getColumns();
		$this->loadView($this->subdir ."menus", $data, $this->template);
	}

	public function create($name)
	{
		$view = "";
		$data = array();
		$this->title = "Create";

		if (property_exists($this->database, $name)) {
			$view = substr($name, 0, -1);
			$this->title .= " " .ucfirst($view);

			if ($this->util->checkMethod("POST") && isset($_POST["create"])) {
				$array = $this->validate($view);
				$data["error"] = $this->util->getErrorMessageArray();

				if ($array !== false) {
					$this->database->$name->insert($array);
					redirect($this->subdir .$name);
				}
			}
		}
		$this->loadView($this->subdir .$view, $data, "blank");
	}

	public function edit($name, $id)
	{
		$view = "";
		$data = array();
		$this->title = "Edit";

		if (property_exists($this->database, $name)) {
			$view = substr($name, 0, -1);
			$this->title .= " " .ucfirst($view);
			$data[$view] = $this->database->menus->getById($id);

			if ($this->util->checkMethod("POST") && isset($_POST["edit"])) {
				$array = $this->validate($view);
				if ($array !== false) {
					$this->database->menus->edit($array);
					redirect($this->subdir .$name);
				}
			}
		}
		$this->loadView($this->subdir .$view, $data, "blank");
	}

	public function delete($name, $id)
	{
		if ($name === "menus") {
			$this->database->menus->delete($id);
		} elseif($name === "pages") {
			$this->database->pages->delete($id);
		} else {
			# Redirect to login
			redirect("panel/login");
		}
		redirect("panel/" .$name);
	}

	private function auth()
	{
		# todo: unify login and register
	}

	private function validate($name)
	{
		switch ($name) {
			case "menu": return $this->validateMenu();
			case "page": return $this->validatePage();
			default: return false;
		}
	}

	private function validateMenu()
	{
		$res = true;

		$id = (! empty($_POST["id"])) ? $this->util->formatHTMLInput($_POST["id"]) : "";
		$name = (! empty($_POST["name"])) ? $this->util->formatHTMLInput($_POST["name"]) : "";
		$url = (! empty($_POST["url"])) ? $this->util->formatHTMLInput($_POST["url"]) : "";
		
		if (empty($name)) {
			$res = false;
			$this->util->setErrorMessage("name", "Name can't be empty.");
		}

		if (empty($url)) {
			$res = false;
			$this->util->setErrorMessage("url", "URL can't be empty.");
		}

		$array = array("name" => $name, "url" => $url);
		if (! empty($id)) $array["id"] = $id;

		return ($res) ? $array : false;
	}

	private function validatePage()
	{
		$res = true;

		$id = (! empty($_POST["id"])) ? $this->util->formatHTMLInput($_POST["id"]) : "";
		$url = (! empty($_POST["url"])) ? $this->util->formatHTMLInput($_POST["url"]) : "";
		$title = (! empty($_POST["title"])) ? $this->util->formatHTMLInput($_POST["title"]) : "";
		$body = (! empty($_POST["body"])) ? $this->util->formatHTMLInput($_POST["body"]) : "";

		if (empty($title)) {
			$res = false;
			$this->util->setErrorMessage("title", "Title can't be empty.");
		}

		if (empty($url)) {
			$res = false;
			$this->util->setErrorMessage("url", "URL can't be empty.");
		}

		$array = array("url" => $url, "title" => $title, "body" => $body);
		if (! empty($id)) $array["id"] = $id;

		return ($res) ? $array : false;
	}
}
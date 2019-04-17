<?php
class PanelController extends Controller
{
	protected $auth;
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
			redirect($this->subdir ."login");
		}
		#$this->loadView($this->subdir ."home", array(), $this->template);

		$this->pages();
	}

	public function login()
	{
		$this->auth(true);
	}

	public function register()
	{
		$this->auth(false);
	}

	public function logout()
	{
		$this->auth->logout();
		redirect($this->subdir);
	}

	public function pages()
	{
		if (! $this->auth->checkUserSession()) {
			redirect($this->subdir);
		}
		$data["pages"] = $this->database->pages->getAll();
		$data["columns"] = $this->database->pages->getColumns();
		$this->loadview($this->subdir ."pages", $data, $this->template);
	}

	public function menus()
	{
		if (! $this->auth->checkUserSession()) {
			redirect($this->subdir);
		}
		$data["menus"] = $this->database->menus->getAll();
		$data["columns"] = $this->database->menus->getColumns();
		$this->loadView($this->subdir ."menus", $data, $this->template);
	}

	public function configuration()
	{
		if (! $this->auth->checkUserSession()) {
			redirect($this->subdir);
		}
		if ($this->util->checkMethod("POST") && isset($_POST["save"])) {
			$array = $this->validateConfig();
			if ($array !== false) {
				if (empty($this->siteConfig))
					$this->database->siteConfig->insert($array);
				else
					$this->database->siteConfig->edit($array);
				
				redirect($this->subdir);
			}
		}
		$data["sc"] = $this->siteConfig;
		$data["error"] = $this->util->getErrorMessageArray();
		$this->loadView($this->subdir ."configuration", $data, $this->template);
	}

	public function create($name)
	{
		if (! $this->auth->checkUserSession()) {
			redirect($this->subdir);
		}
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
		if (! $this->auth->checkUserSession()) {
			redirect($this->subdir);
		}
		$view = "";
		$data = array();
		$this->title = "Edit";

		if (property_exists($this->database, $name)) {
			$view = substr($name, 0, -1);
			$this->title .= " " .ucfirst($view);
			$data[$view] = $this->database->$name->getById($id);

			if ($this->util->checkMethod("POST") && isset($_POST["edit"])) {
				$array = $this->validate($view);
				if ($array !== false) {
					$this->database->$name->edit($array);
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

	private function auth(bool $loginMode)
	{
		if ($this->auth->checkUserSession()) {
			redirect($this->subdir);
		}

		$data = array();
		$data["loginMode"] = $loginMode;
		$data["registerFinished"] = false;

		if ($this->util->checkMethod("POST")) {
			$name = (! empty($_POST["name"])) ? $this->util->formatHTMLInput($_POST["name"]) : "";
			$email = (! empty($_POST["email"])) ? $this->util->formatHTMLInput($_POST["email"]) : "";
			$pass = (! empty($_POST["password"])) ? $this->util->formatHTMLInput($_POST["password"]) : "";
			$keep = (! empty($_POST["keep-session"])) ? true : false;

			if (isset($_POST["login"])) {
				if ($this->auth->login($email, $pass, true)) {
					#header("Location: " .BASE_URL ."panel");
					redirect($this->subdir);
				} else {
					$this->util->setErrorMessage("login", "Failed to login. Check your e-mail or password and try again.");
				}
			} elseif (isset($_POST["register"])) {
				if ($this->auth->register(array("name" => $name, "email" => $email, "password" => $pass))) {
					$data["registerFinished"] = true;
				}
			}
		}

		$data["error"] = $this->util->getErrorMessageArray();
		$this->loadView($this->subdir ."authentication", $data, "blank");
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

	private function validateConfig()
	{
		$res = true;

		$id = (! empty($_POST["id"])) ? $this->util->formatHTMLInput($_POST["id"]) : "";
		
		$title = (empty($_POST["title"])) ? (! empty($this->siteConfig["title"]) ? $this->siteConfig["title"] : "") : $this->util->formatHTMLInput($_POST["title"]);

		$banner = (isset($_FILES["banner"]) && ! empty($_FILES["banner"]["name"])) ? $_FILES["banner"] : (! empty($this->siteConfig["home_banner"]) ? $this->siteConfig["home_banner"] : "");

		$welcome = (empty($_POST["welcome"])) ? (! empty($this->siteConfig["home_welcome"]) ? $this->siteConfig["home_welcome"] : "") : $this->util->formatHTMLInput($_POST["welcome"]);

		$template = (empty($_POST["template"])) ? (! empty($this->siteConfig["template"]) ? $this->siteConfig["template"] : "") : strtolower($this->util->formatHTMLInput($_POST["template"]));

		if (empty($title)) {
			$res = false;
			$this->util->setErrorMessage("title", "Site name can't be empty.");
		}

		if (! empty($banner)) {
			$supportedTypes = array("image/jpeg", "image/png");
			
			if (isset($banner["type"])) {
				$type = $banner["type"];
				if (in_array($type, $supportedTypes)) {
					$tmpName = md5(time() .rand(0, 9999)) .".jpg";
					$imagePath = "assets/img/banner/" .$tmpName;
					move_uploaded_file($banner["tmp_name"], $imagePath);

					$banner = $tmpName;
				}
			}
		}
		#echo $template; die;

		$array = array("title" => $title, "template" => $template, "home_banner" => $banner, "home_welcome" => $welcome);
		if (! empty($id)) $array["id"] = $id;

		return ($res) ? $array : false;
	}
}
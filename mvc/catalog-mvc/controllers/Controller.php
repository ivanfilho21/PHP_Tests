<?php

abstract class Controller
{
	protected $title = "Catalog";
	protected $viewName = "";
	protected $viewData = array();

	public abstract function index();

	public function loadView($viewName="")
	{
		$viewName = (empty($viewName)) ? $this->viewName : $viewName;
		require "views/template/template.php";
	}

	private function loadViewInTemplate($viewName)
	{
		# transforms keys into variables
		extract($this->viewData);

		if (file_exists("views/" .$viewName .".php")) {
			require "views/" .$viewName .".php";
		} else {
			?>
			<input type="hidden" data-base-url="<?php echo BASE_URL; ?>">
			<script>
				var baseUrl = document.getElementById("data-base-url").value;
				window.location.href = baseUrl + "views/404.php";
			</script>
			<?php
			#header("Location: " .BASE_URL ."views/404.php");
			exit();
		}
		
	}
} 
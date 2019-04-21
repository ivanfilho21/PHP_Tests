<?php
class Language
{

	public function __construct()
	{
		$name = (! empty($_SESSION["lang"])) ? $_SESSION["lang"] : "";
		$file = ROOT_PATH ."/lang/" .$name .".ini";

		$this->language = (file_exists($file)) ? $_SESSION["lang"] : "en";

		$file = ROOT_PATH ."/lang/" .$this->language .".ini";

		# converts ini file into array
		$this->ini = parse_ini_file($file);
	}

	public function getLanguage()
	{
		return $this->language;
	}

	public function get($word, $return=false)
	{
		$t = $word;

		if (isset($this->ini[$word])) {
			$t = $this->ini[$word];
		}

		if ($return) {
			return $t;
		}

		echo $t;
	}
}
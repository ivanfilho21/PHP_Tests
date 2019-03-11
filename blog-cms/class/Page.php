<?php
class Page {
	private $id = 0;
	private $title = "";

	public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

	public function getTitle()
	{
		return $this->title;
	}

	public function getTitle($title)
	{
		$this->title = $title;
	}
}
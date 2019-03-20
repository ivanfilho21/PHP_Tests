<?php

class PasswordReset
{
	public function __construct($id, $email, $selector, $token, $expireDate)
	{
		$this->setId($id);
		$this->setEmail($email);
		$this->setSelector($selector);
		$this->setToken($token);
		$this->setExpireDate($expireDate);
	}
	public function getId()
	{
		return $this->id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getSelector()
	{
		return $this->selector;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function getExpireDate()
	{
		return $this->expireDate;
	}

	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setSelector($selector)
	{
		$this->selector = $selector;
	}

	public function setToken($token)
	{
		$this->token = $token;
	}

	public function setExpireDate($expireDate)
	{
		$this->expireDate = $expireDate;
	}
}
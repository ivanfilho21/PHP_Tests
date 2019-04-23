<?php
class Usuarios
{
	public function __construct($db)
	{
		$this->db = $db;
		$this->tabela = "`usuarios`";
		$this->criarTabela();
	}

	public function criarTabela()
	{
		$sql = "CREATE TABLE IF NOT EXISTS " .$this->tabela ." (
		`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		`nome` VARCHAR(100) NOT NULL,
		`email` VARCHAR(100) NOT NULL,
		`senha` VARCHAR(32) NOT NULL
		)";
		$this->db->query($sql);
	}

	public function inserir($nome, $email, $senha)
	{
		$sql = "INSERT INTO " .$this->tabela ." (`nome`, `email`, `senha`) VALUES (
		'" .$nome ."', '" .$email ."', '" .md5($senha) ."')";

		$this->db->query($sql);
	}

	public function pegar($email, $senha)
	{
		$sql = "SELECT * FROM " .$this->tabela ." WHERE `email` = '" .$email ."' AND `senha` = '" .md5($senha) ."'";
		$res = $this->db->query($sql);
		if ($res->rowCount() == 1) {
			return $res->fetch();
		}
		return false;
	}

	public function emailExiste($email)
	{
		$sql = "SELECT * FROM " .$this->tabela ." WHERE `email` = '" .$email ."'";
		$res = $this->db->query($sql);
		if ($res->rowCount() > 0) {
			return true;
		}
		return false;
	}
}
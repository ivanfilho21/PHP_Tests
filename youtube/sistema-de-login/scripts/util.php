<?php
session_start();

function usuarioLogado()
{
	if (isset($_SESSION["sessao-usuario"])) {
		return true;
	}
	return false;
}
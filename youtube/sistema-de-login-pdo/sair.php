<?php
require "util.php";
session_start();
unset($_SESSION["sessao-usuario"]);
redirecionar();
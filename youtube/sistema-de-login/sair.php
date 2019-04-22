<?php
include "scripts/util.php";

unset($_SESSION["sessao-usuario"]);
header("Location: index.php");
exit();
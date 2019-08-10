<?php
session_start();
require "config.php";
require "routers.php";

$user = getLoggedUser();

$core = new FriendlyURL();
$core->run();
?>
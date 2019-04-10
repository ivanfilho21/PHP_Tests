<?php
session_start();
require "autoload.php";
require "config.php";

$core = new Core();
$core->start($database);
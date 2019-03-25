<?php

spl_autoload_register(function($class) {
	require "classes/" .$class. ".php";
});
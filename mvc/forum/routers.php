<?php

global $routers;
$routers = array();

$routers["/"] = "/home/index";
$routers["/index"] = "/home/index";
$routers["/index/"] = "/home/index";
$routers["/authentication"] = "/home/index";
$routers["/authentication/"] = "/home/index";

$routers["/boards/{url}"] = "/board/open/:url";
$routers["/boards/{url}/"] = "/board/open/:url";
$routers["/boards/{url}/{page}"] = "/board/open/:url/:page";
$routers["/boards/{url}/{page}/"] = "/board/open/:url/:page";

$routers["/topics/{url}"] = "/topic/open/:url";
$routers["/topics/{url}/"] = "/topic/open/:url";
$routers["/topics/{url}/{page}"] = "/topic/open/:url/:page";
$routers["/topics/{url}/{page}/"] = "/topic/open/:url/:page";
$routers["/topics/{url}/{page}/{post}"] = "/topic/open/:url/:page/:post";
$routers["/topics/{url}/{page}/{post}/"] = "/topic/open/:url/:page/:post";

$routers["/users/{url}"] = "/profile/open/:url";
$routers["/users/{url}/"] = "/profile/open/:url";
$routers["/profile"] = "/profile/edit";
$routers["/profile/"] = "/profile/edit";
$routers["/users/{url}/{section}"] = "/profile/open/:url/:section";
$routers["/users/{url}/{section}/"] = "/profile/open/:url/:section";

$routers["/logout"] = "/authentication/logout";
$routers["/logout/"] = "/authentication/logout";
$routers["/sign-out"] = "/authentication/logout";
$routers["/sign-out/"] = "/authentication/logout";
$routers["/login"] = "/authentication/login";
$routers["/login/"] = "/authentication/login";
$routers["/sign-in"] = "/authentication/login";
$routers["/sign-in/"] = "/authentication/login";
$routers["/register"] = "/authentication/register";
$routers["/register/"] = "/authentication/register";
$routers["/sign-up"] = "/authentication/register";
$routers["/sign-up/"] = "/authentication/register";
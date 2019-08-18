<?php

use \Wilkins\PackageLoader\PackageLoader;

session_start();

// define("ROOT", getcwd() ."/");
define("ROOT", __DIR__ ."/");
define("VIEW", ROOT ."app/src/mvc/view/");
define("TEMPLATE", ROOT ."app/src/mvc/view/templates/");
define("ENVIRONMENT", "dev");

if (defined("ENVIRONMENT") && ENVIRONMENT === "dev") {
    define("DB_TYPE", "mysql");
    define("DB_NAME", "forum_db");
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
    // define("URL", "http://localhost/dev/php-tests/mvc/forum/");
    $array = explode("/", $_SERVER["PHP_SELF"]);
    array_shift($array);
    array_pop($array);
    define("URL", $_SERVER["REQUEST_SCHEME"] ."://" .$_SERVER["SERVER_NAME"] ."/" .implode("/", $array) ."/");

    define("ASSETS", URL ."assets/");
    define("REL_TEMPLATE", URL ."app/src/mvc/view/templates/");
    define("REL_PAGE", URL ."app/src/mvc/view/pages/");
    define("SITE_NAME", "Fórum - [DEV MODE]");
} else {
    define("SITE_NAME", "Fórum");
}

require "app/src/packages/wilkins/composer-file-loader/src/PackageLoader.php";

$loader = new PackageLoader();
$loader->load(ROOT ."app/src");

# Database Admin object
$dba = \App\Database\DBA::getInstance();

# Authentication
$auth = new \IvanFilho\Authentication\Authentication($dba->getTable("users"));

# Date and Time
$date = new \IvanFilho\Date\Date();




# Default values
/*$now = $date->getCurrentDateTime();

#$u = new \User(0, \User::TYPE_ADMIN_USER, "admin", "", md5("prec"), $now);
#$dba->getTable("users")->insert($u);

$c = new \Category(0, "Categoria", $now);
$dba->getTable("categories")->insert($c);

$b = new \Board(0, 1, 1, "Board de Exemplo", "Descrição da Board.", $now);
$dba->getTable("boards")->insert($b);*/



# Template Configuration
$template = "default";
$title = "";
$scripts = array();
$styles = array();

function redirect($url = "", $replace = false, $timeInMillis = false)
{
    ?>
    <script>
        const url = "<?php echo URL .$url; ?>";
        const replace = "<?php echo $replace; ?>";
        const time = "<?php echo $timeInMillis; ?>";

        let redirect = function() {
            if (replace) {
                window.location.replace(url);
            } else {
                window.location.href = url;
                // window.location.open(url, "_self");
            }
        };

        if (time) {
            window.setTimeout(redirect, parseInt(time));
        } else {
            redirect();
        }
    </script>
    <?php
    exit();
}

function format(String $d)
{
    $d = trim($d);
    $d = stripslashes($d);
    $d = htmlspecialchars($d);
    // $d = utf8_decode($d);

    return $d;
}

function showErrorMessages()
{
    ?>
    <?php if (! empty($_SESSION["error-msg"])): ?>
    <div class="alert alert-danger">
        <span class="b">Foram encontrados os seguintes erros:</span>
        <ul class="ul ul-circle">
        <?php foreach($_SESSION["error-msg"] as $err): ?>
            <?php if (! empty($err)): ?>
            <li><?= $err ?></li>
            <?php endif ?>
        <?php endforeach ?>
        </ul>
    </div>
    <?php unset($_SESSION["error-msg"]) ?>
    <?php endif ?>
    <?php
}

function encodeUrlFromName($string)
{
    $array = explode(" ", removeAccents(strtolower($string)));
    return implode("-", $array);
}

function removeAccents($string)
{
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function plural(int $n, $str)
{
    if ($n == 1) return $str;

    $lc = substr($str, -1);
    if ($lc == "m") {
        $str = substr($str, 0, strlen($str) -1) ."n";
    } elseif ($lc == "s") {
        $str .= "e";
    } elseif ($lc == "o") {
        if (mb_substr($str, strlen($str) -4, strlen($str), "UTF-8") == "ão") {
            $str = mb_substr($str, 0, strlen($str) -4, "UTF-8") ."õe";
        }
    }

    return $str ."s";
}
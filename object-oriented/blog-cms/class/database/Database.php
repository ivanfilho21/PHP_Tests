<?php

# SQL Types
define("INT", "INT");
define("VARCHAR", "VARCHAR");
define("MD5", "MD5");

# Useful characters
define("COMMA", ", ");
define("QT_A", "`");
define("QT", "'");

class Database
{
    private $mysqli;

    public function __construct($host, $user, $pass, $name)
    {
        $mysqli = new mysqli($host, $user, $pass, $name);

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            die();
        }

        $this->mysqli = $mysqli;
    }

    public function getMysqli()
    {
        return $this->mysqli;
    }

    public function setMysqli($mysqli)
    {
        $this->mysqli = $mysqli;
    }
}
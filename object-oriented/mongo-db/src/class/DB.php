<?php

require "../vendor/autoload.php";

use MongoDB\Client as MongoDB;
use MongoDB\BSON\ObjectId as ObjectId;

class DB
{
    public $objectId = null;

    static function getConnection()
    {
        return new MongoDB("mongodb://localhost:27017");
    }

    static function getObjectId(String $id)
    {
        if (preg_match("/^[0-9a-f]{24}$/i", $id)) {
            return new ObjectId($id);
        }
        return 0;        
    }
}
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
        if (empty($id)) return 0;
        return new ObjectId($id);
    }
}
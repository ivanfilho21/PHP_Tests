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
        return new ObjectId($id);
    }
}
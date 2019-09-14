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

    static function count(String $collection)
    {
        return self::getConnection()->test->$collection->count();
    }

    static function find(
        String $collection,
        array $filter = array(),
        String $sortColum = "_id",
        int $skip = 0,
        int $limit = 0)
    {
        $options = array(
            "sort" => array($sortColum => 1),
            "skip" => $skip,
            "limit" => $limit
        );

        return self::getConnection()->test->$collection->find($filter, $options);
    }
}
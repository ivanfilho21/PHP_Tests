<?php

namespace IvanFilho\Date;

# Seconds in every period of time.
const YEAR = 31536000;
const MONTH = 2592000;
const DAY = 86400;
const HOUR = 3600;
const MINUTE = 60;

class Date
{
    private static function checkPlural($diff)
    {
        return ($diff == 1) ? "" : "s";
    }

    public static function getCurrentDate()
    {
        date_default_timezone_set("America/Sao_Paulo");
        return date("Y-m-d H:i:s");
    }

    public static function timeDiff(String $date = "", $asString = false)
    {
        if (empty($date)) return 0;

        date_default_timezone_set("America/Sao_Paulo");

        $date = strtotime($date);
        $now = time();

        // $diff = abs($now - $date);
        $diff = $now - $date;
        return ($asString) ? self::translateTimeToString($diff) : $diff;
    }

    private static function translateTimeToString(int $time)
    {
        $diff = $time;
        $append = "";

        if ($diff < MINUTE) {
            $append .= " segundo" .self::checkPlural($diff);
        } elseif ($diff < HOUR) {
            $diff = floor($diff / MINUTE);
            $append .= " minuto" .self::checkPlural($diff);
        } elseif ($diff < DAY) {
            $diff = floor($diff / HOUR);
            $append .= " hora" .self::checkPlural($diff);
        } elseif ($diff < MONTH) {
            $diff = floor($diff / DAY);
            $append .= " dia" .self::checkPlural($diff);
        } elseif ($diff >= MONTH && $diff < YEAR) {
            $diff = floor($diff / MONTH);
            $append .= " m" .($diff == 1) ? "ê" : "ese" ."s";
        } else {
            $diff = floor($diff / YEAR);
            $append .= " ano" .self::checkPlural($diff);
        }

        return $diff .$append;
    }
}
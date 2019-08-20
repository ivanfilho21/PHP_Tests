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
    public function __construct()
    {}

    public function getCurrentDateTime()
    {
        date_default_timezone_set("America/Sao_Paulo");
        return date("Y-m-d H:i:s");
    }

    public function translateToDate(String $str)
    {
        date_default_timezone_set("America/Sao_Paulo");
        return date("d/m/Y", strtotime($str));
    }

    public function translateToTime($str)
    {
        if (empty($str)) return "";
        date_default_timezone_set("America/Sao_Paulo");
        return date("H:i", strtotime($str));
    }

    public function translateToDateTime(String $str)
    {
        date_default_timezone_set("America/Sao_Paulo");
        return date("d/m/Y\, H:i", strtotime($str));
    }

    public function translateTime($str, $mode = 0)
    {
        if (empty($str)) return "";
        date_default_timezone_set("America/Sao_Paulo");

        $date = strtotime($str);
        $now = time();
        $diff = $now - $date;

        switch ($mode) {
            case 0:
                return self::translateTimeToString($diff);
                break;
            case 1:
                return $this->basedOnToday($str, $diff);
                break;
            default: break;
        }
    }

    private function basedOnSeconds(int $diff)
    {
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

    private function basedOnToday(String $date, int $diff)
    {
        // echo $diff, ", ", DAY, " ";
        if ($diff < DAY - HOUR*12) {
            return "hoje";
        } elseif ($diff < 2*DAY - HOUR*12) {
            return "ontem";
        } else {
            return $this->translateToDate($date);
        }

        return $append;
    }

    private static function checkPlural($diff)
    {
        return ($diff == 1) ? "" : "s";
    }
}
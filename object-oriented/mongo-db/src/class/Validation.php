<?php

class Validation
{
    
    static function validateDate(String $date)
    {
        $res = true;
        $regex = "/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/";

        if (! preg_match($regex, $date)) {
            $res = false;
            $_SESSION["error"]["date"] = "Data inválida.";
        }

        if ($res) {
            unset($_SESSION["error"]["date"]);
        }

        return $res;
    }

    static function validatePrize(String $prize)
    {
        $res = true;

        if (strpos($prize, ".") !== false | ! filter_var(floatval($prize), FILTER_VALIDATE_FLOAT)) {
            $res = false;
            $_SESSION["error"]["prize"] = "Valor inválido.";
        }

        if ($res) {
            unset($_SESSION["error"]["prize"]);
        }

        return $res;
    }

    static function validateDrawNumber(String $number)
    {
        $regex = "/^[1-9]+([0-9]*)$/";
        $res = preg_match($regex, $number);
        global $conn;

        if ($res) {
            $cd = $conn->test->megasena->find(array("Concurso" => intval($number)));
            if (! empty($cd->toArray())) {
                $res = false;
                $_SESSION["error"]["number"] = "Já existe um sorteio com esse número.";
            }
        } else {
            $_SESSION["error"]["number"] = "Digite um número maior que Zero.";
        }

        if ($res) {
            unset($_SESSION["error"]["number"]);
        }

        return $res;
    }

    public static function validate(String $date, String $prize, String $number)
    {
        $res = true;
        
        $res = self::validateDate($date) & self::validatePrize($prize) & self::validateDrawNumber($number);

        if ($res) {
            self::resetMessages();
        }

        return $res;
    }

    public static function resetMessages()
    {
        unset($_SESSION["error"]);
    }
}
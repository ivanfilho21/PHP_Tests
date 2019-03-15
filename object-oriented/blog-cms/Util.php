<?php

class Util
{
    public static $errorMsgs = array();

    public static function formatHTMLInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public static function setErrorMessage(string $index, string $msg)
    {
        global $errorMsgs;
        $errorMsgs[$index] = $msg;
    }

    public static function showError(string $index)
    {
        global $errorMsgs;
        echo (isset($errorMsgs[$index])) ? $errorMsgs[$index] : "";
    }

    public static function checkUserSession()
    {
        return Authentication::getLoggedUser() != null;
    }

}
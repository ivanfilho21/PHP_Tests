<?php

class Util
{
    public $errorMsgs = array();

    public function __construct()
    {
        #
    }

    public function formatHTMLInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public function setErrorMessage(string $index, string $msg)
    {
        global $errorMsgs;
        $errorMsgs[$index] = $msg;
    }

    public function showError(string $index)
    {
        global $errorMsgs;
        echo (isset($errorMsgs[$index])) ? $errorMsgs[$index] : "";
    }

}
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

    public function redirectTo($relPath, $page)
    {
        ?>
        <span id="redirectTo" data-relpath="<?php echo $relPath; ?>" data-page="<?php echo $page; ?>"></span>
        <script>
            var relPath = document.getElementById("redirectTo").getAttribute("data-relpath");
            var page = document.getElementById("redirectTo").getAttribute("data-page");

            window.location.href = relPath + page;
        </script>
        <?php
        exit();
    }

    public function redirectToDashboard($relPath)
    {
        $this->redirectTo($relPath, "dashboard.php");
    }

}
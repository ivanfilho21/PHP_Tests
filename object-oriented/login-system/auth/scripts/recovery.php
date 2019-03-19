<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # Recovery First Time
    if (isset($_POST["recovery"])) {
        #
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        # Website URL
        $url = "localhost/dev/php-tests/login-system/auth/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

        $expires = date("U") + 1800;




        # old
        $email = $util->formatHTMLInput($_POST["email"]);
        # check if email exists
        if ($auth->checkEmailInDatabase($email)) {
            # TODO: send link of recovery to email

            $recoverySent = true;
        }
        else {
            $util->setErrorMessage("recovery-email", "Não há uma conta associada a este e-mail.");
            $res = false;
        }
    }
}



<?php

$recoverySent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # Recovery First Time
    if (isset($_POST["recovery"])) {
        $email = $util->formatHTMLInput($_POST["email"]);
        
        # check if email exists in database
        if ($auth->getUserByEmail($email) != null) {
            #
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            # Website URL
            $url = "localhost/dev/php-tests/login-system/auth/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

            $expires = date("U") + 1800;

            # One token per user, delete an existing token
            $auth->deletePasswordResetRequest($email);

            # Create a new token
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            $auth->createPasswordResetRequest($email, $selector, $hashedToken, $expires, $url);

            $recoverySent = true;
        }
        else {
            $util->setErrorMessage("recovery-email", "Não há uma conta associada a este e-mail.");
            $res = false;
        }
    }
}



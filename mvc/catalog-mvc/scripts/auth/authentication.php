<?php
$util = new Util();
$usersTable = $database->getUsersTable();
$finished = false;

$name = "";
$email = "";
$phone = "";

if ($util->checkMethod("POST")) {

	if (isset($_POST["register"])) {
		$name = $util->formatHTMLInput($_POST["name"]);
		$email = $util->formatHTMLInput($_POST["email"]);
		$password = $util->formatHTMLInput($_POST["password"]);
		$passRepeat = $util->formatHTMLInput($_POST["password-repeat"]);
		$phone = $util->formatHTMLInput($_POST["phone"]);

		if (passwordValidation($util, $password, $passRepeat)) {
			$userArray = array("name" => $name, "email" => $email, "password" => md5($password), "phone" => $phone);
			if ($usersTable->register($userArray)) {
				$finished = true;
			}
			else {
				$util->setErrorMessage("email", "This e-mail has already been registered. <a href='" .BASE_URL ."authentication/login'>Login here</a>.");
			}
		}
	}
	elseif (isset($_POST["login"])) {
		$email = $util->formatHTMLInput($_POST["email"]);
		$password = $util->formatHTMLInput($_POST["password"]);

		$userArray = array("email" => $email, "password" => md5($password));
		$id = $usersTable->login($userArray);
		
		if ($id == false) {
			$util->setErrorMessage("login", "Failed to login. Check your e-mail and password and try again.");
		}
		else {
			setUserSession($id);

			# Redirect to index page
			?>
			<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
			<script>
				var baseUrl = document.getElementById("data").getAttribute("data-base-url");
				window.location.href = baseUrl;
			</script>
			<?php
			#header("Location: " .BASE_URL);
			exit();
		}
	}
}

function passwordValidation($util, $pass1, $pass2)
{
	$res = true;

	if (strlen($pass1) < 6 || strlen($pass2) < 6) {
		$util->setErrorMessage("password", "Your password is too short. The minimum length is 6.");
		$res = false;
	}
	elseif ($pass1 !== $pass2) {
		$util->setErrorMessage("password", "Passwords don't match.");
		$res = false;
	}

	return $res;
}
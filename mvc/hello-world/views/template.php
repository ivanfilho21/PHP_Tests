<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo ucfirst($viewName); ?></title>
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/"; ?>style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/" .$viewName; ?>.css">
</head>
<body>
	<h3>Header</h3>
	<a href="<?php echo BASE_URL; ?>">Home</a>
	<a href="<?php echo BASE_URL; ?>about">About</a>
	<hr>
	
	<?php $this->loadViewInTemplate($viewName, $viewData); ?>

	<hr>
	<h3>Footer</h3>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->title; ?></title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
	<!-- Mobile specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="darkslategray">
</head>
<body>
	<?php $this->loadViewIntoTemplate($viewName, $viewData); ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Note</title>
	<link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
</head>
<body>

	<?php if(isset($user) && $user) :?>
		<?php require_once "public/view/templates/nav-user-exist.php";?>
	<?php else :?>
		<?php require_once "public/view/templates/nav-user-default.php";?>
	<?php endif; ?>
	

<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION["username"]; ?></title>
</head>
<body>

	<?php echo $_SESSION["id"]; ?><br>
	<?php echo $_SESSION["username"]; ?><br>
	<?php echo $_SESSION["fname"]; ?><br>
	<?php echo $_SESSION["lname"]; ?><br>

</body>
</html>
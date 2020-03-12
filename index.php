<?php 
session_start();
$conn = mysqli_connect("localhost","root","","nsrotution");

if (!$conn) {
	die("Unable Connect");
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>NsroTution</title>
</head>
<body>

	<form action="#" method="POST">
		<input type="text" name="username" placeholder="Enter your Username"><br>
		<input type="password" name="password" placeholder="Enter your Password"><br>

		<input type="submit" value="Sign In" name="signin"><br>
	</form>

<br>
<br>
<br>

	

	<form action="#" method="POST">
		<input type="text" name="username" placeholder="Choose Username"><br>
		<input type="text" name="fname" placeholder="Enter First name"><br>
		<input type="text" name="lname" placeholder="Enter Last name"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="password" name="rpassword" placeholder="Repeate Password"><br>

		<input type="submit" value="Sign Up" name="signup"><br>
	</form>

</body>
</html>


<?php 
if (isset($_POST["signup"])) {
	$username = $_POST["username"];
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$pass = $_POST["password"];
	$rpass = $_POST["rpassword"];

	if ($username != "" AND $pass != "" AND $rpass != "") {

		if ($rpass == $pass) {

			$query = mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'");

			$numofRows = mysqli_num_rows($query);

			if ($numofRows != 0) {
				echo "Already Exist";

			}else{

				$enc_pass = md5($pass);
				mysqli_query($conn, "INSERT INTO users(username,fname,lname,password) VALUES('$username','$fname','$lname','$enc_pass')");
			}

		}else{
			echo "<span style='color:red'>Sorry Passwords do not match!</span>";
		}
		
	}else{
		echo "<span style='color:red'>Please no field should be empty!</span>";
	}


}


if (isset($_REQUEST["signin"])) {
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];

	if ($username != "") {
		if ($password != "") {

			$enc_pass = md5($password);
			$query = mysqli_query($conn, "SELECT * FROM users WHERE username ='$username' AND password='$enc_pass'");
			$numofRows = mysqli_num_rows($query);

			if ($numofRows!=0) {
				$fetch = mysqli_fetch_assoc($query);
				$_SESSION["id"] = $fetch["id"];
				$_SESSION["username"] = $fetch["username"];
				$_SESSION["fname"] = $fetch["fname"];
				$_SESSION["lname"] = $fetch["lname"];

				header("Location:home.php");
			}else{
				echo "Username and password does not match!";
			}

		}else{
			echo "Enter Passwords";
		}
	}else{
		echo "Enter Username";
	}
}


?>
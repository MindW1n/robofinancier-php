<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>Registration</title>
</head>
<body>
<?php 
spl_autoload_register( function($classname){ require_once "$classname" . "Class.php";});
require_once("connect.php");
if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"]))
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	$username =  $_POST["username"];
	$registration_obj = new RegistrationPage($email, $username, $password, $PDO);
	$result_login = $registration_obj->check_user_existence();
	if($result_login === 1)
	 	{
	 		$flsmsg = "Sorry, the account has already been created:(";
	 	}
	 	else 
	 	{
			$result = $registration_obj->register_user();
			$ssmsg = "Successfully!";
	 	}
}
?>
<div>
	<form method="POST" class="form-signin">
		<h2 class="h2__Registration">Registration</h2>
		<?php if(isset($ssmsg)) {?> <div class="alert alert-success" role="alert"><h3><? echo $ssmsg; ?></h3></div> <?} if (isset($flsmsg)) {?> <div class="alert alert-danger" role="alert"><h3><? echo $flsmsg; ?></h3></div> <?} ?>
		<input type="text" name="username" class="form-control" placeholder="Username" required>
		<input type="email" name="email" class="form-control" placeholder="Email" required>
		<input type="password" name="password" class="form-control" placeholder="Password" required>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Register</button>
		</form>
		<a href="index.php" class="btn-lg btn-primary btn-block btn">Login</a>
	</div>
</body>
</html>
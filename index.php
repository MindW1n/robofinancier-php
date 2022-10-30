<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>RoboFinancier</title>
</head>
<body>
	 <?php  
	 	require_once("connect.php");
	 	spl_autoload_register( function($classname){ require_once "classes/$classname" . "Class.php";});
	 	if(isset($_REQUEST['email']))
	 	{	
	 		$email = $_REQUEST['email'];
	 		$password = $_REQUEST['password'];
	 		$login_obj = new LoginPage($email, $password, $pdo_obj);
	 		$result_login = $login_obj->check_password();
	 		if($result_login === 1)
	 		{
	 			$username = $login_obj->get_username();
	 			$id = $login_obj->get_id();
	 			$_SESSION['username'] = $username;
	 			$_SESSION['email'] = $email;
	 			$_SESSION['author_id'] = $id;
	 			$ssmsg = "Success!!! Welcome, $username. You've entered:)";
	 		}
	 		else 
	 		{
	 			$flsmsg = "Sorry! I don't know who you are. Please try again:(";
	 		}
	 	}
	 	if(isset($_SESSION['username']))?> <h2 class="h2__username"><?php echo $_SESSION['username']?></h2>
	 <div>
		<form method="POST" class="form-signin">
			<h2 class="h2__Registration">Login</h2>
			<?php if(isset($ssmsg)) { ?> 
				<div class="alert alert-success" role="alert">
					<h3><?php echo $ssmsg; ?></h3>
				</div> 
			<?php } if(isset($flsmsg)) { ?> 
				<div class="alert alert-danger" role="alert">
					<h3><?php echo $flsmsg; ?></h3></div>
			<?php } ?>
			<?php if(!isset($ssmsg)) { ?>
				<input type="text" name="email" placeholder="Email" class="form-control" required>
				<input type="password" name="password" placeholder="Password" class="form-control" required><br>
				<button class="btn btn-primary btn-block btn-lg" id='btn__register'>Login</button> 
			 <?php  } ?>
		</form>
		<?php if(!isset($_REQUEST['email'])) { ?> 
			<a href="assets/html/registration.php" class="btn btn-primary btn-block btn-lg">Registration</a><br>
		<?php }?>
		<?php if(isset($ssmsg)) { ?>
			<a href="assets/html/financialWork.php" class="btn btn-primary btn-block btn-lg" id='btn__register'>
Let's do financial work!</a> <br><br>
		<a href="logout.php" class="btn btn-primary btn-block btn-lg" id='btn__register'>Logout</a> 
		<?php } ?>
	</div>
</body>
</html>
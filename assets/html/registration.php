<?php 
	spl_autoload_register( function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once("../../connect.php");
	$page_obj = new RegistrationPage();
	// generating header
	echo $page_obj->get_header();
	if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"]))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$username =  $_POST["username"];
		$registration_obj = new Registration($email, $username, $password, $pdo_obj);
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
		<?php if(isset($ssmsg)) { ?> <div class="alert alert-success" role="alert"><h3><?php echo $ssmsg; ?></h3></div> <?php } if (isset($flsmsg)) { ?> <div class="alert alert-danger" role="alert"><h3><?php echo $flsmsg; ?></h3></div> <?php } ?>
		<?php  
			// generating inputs
			echo $page_obj->get_inputs();
		?>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Register</button>
		</form>
		<?php 
			// generating buttons
			echo $page_obj->get_buttons();
		?>
	</div>
</body>
</html>
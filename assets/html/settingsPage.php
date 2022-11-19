<?php  
	session_start();
	spl_autoload_register(function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once("../../connect.php");
	$page_obj = new SettingsPage();
	try {
		$options_obj = Settings::get_settings_obj($pdo_obj);
	}
	catch(Exception $exception) {
		Settings::create_new_settings($pdo_obj);
		$options_obj = Settings::get_settings_obj($pdo_obj);
	}
	if(isset($_REQUEST["cash_free_percent"])) {

		try {

			$out_code = $options_obj->set_properties($_REQUEST["cash_free_percent"], $_REQUEST["brokerAccount_percent"], 
			$_REQUEST["firstDream_percent"], $_REQUEST["secondDream_percent"], $_REQUEST["safetyBag_percent"]);
			if($out_code == 1) {

				$ssmsg = "Your new settings have been successfully created!";
			}
			else {

				$flsmsg = "Sorry, something went wrong!";
			}
		}
		catch(Exception $error) {

			echo $error->getMessage();
		}
	}

	// generating header
	echo $page_obj->get_header();
?>
<body>
	<?php 
		// getting username
		echo $page_obj->get_username();
	?>
		<form method="POST" class="form-signin">
			<?php if(isset($ssmsg)) { ?> 
				<div class="alert alert-success" role="alert">
					<h3><?php echo $ssmsg; ?></h3>
				</div> 
			<?php } if(isset($flsmsg)) { ?> 
				<div class="alert alert-danger" role="alert">
					<h3><?php echo $flsmsg; ?></h3></div>
			<?php } ?>
			<h2 class="title_Bill" style="color:white;">Enter income on deposit and brokerage account</h2>
			<?php 
				// generating inputs
				echo $page_obj->get_inputs();
			?>
			<?php if(!isset($_REQUEST['income_BankAccount']) and !isset($_REQUEST['income_BrokerageAccount'])) {?>
			<button class="btn-lg btn-primary btn-block btn" id="btn__register">Enter</button>
	<?php } ?>
		</form>
	<?php  

		// genarating links
		echo $page_obj->get_buttons();
	?>
</body>
</html>
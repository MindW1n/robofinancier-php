<?php 
	session_start(); 
	spl_autoload_register( function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once('../../connect.php');
	$page_obj = new PutOnAccountsPage();
	// generating header
	echo $page_obj->get_header();
	echo $page_obj->get_username();

	// generating new financial work object
	$page_obj->set_new_financialWork_obj($pdo_obj, $_SESSION["email"]);

	if(isset($_REQUEST['BrokerAcc']) and isset($_REQUEST['BankAcc']))
		{
			$BrokerAcc = $_REQUEST['BrokerAcc'];
			$BankAcc = $_REQUEST['BankAcc'];
			$args = [$pdo_obj, $_SESSION['email'], 0, 0, 0, 0, 0, $BrokerAcc, $BankAcc, 0, 0];
			$page_obj->financial_obj_set_properties($args);
			$page_obj->financial_obj_put_on_BrokerAccount();
			$page_obj->financial_obj_put_on_BankAccount();
			$page_obj->financial_obj_data_base_update();
		sdfkjsdk
		}
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>State of an account</h3>
		</div>
	</div>
	<div>
	<?php 
		echo $page_obj->get_financial_content();
	?>
		<?php if(!isset($_REQUEST['BrokerAcc']) and !isset($_REQUEST['BankAcc'])) { ?>
	<form method="POST" class="form-signin">
		<h2 class="title_Bill" style="color:white;">Enter how much you put on your accounts:</h2>
		<?php 
			echo $page_obj->get_inputs(); // generating inputs
		}
		if(isset($_REQUEST['BrokerAcc']) or isset($_REQUEST['BankAcc'])) { ?><br>
		<a href="putOnAccounts.php" class="btn-lg btn-primary btn-block btn">Enter new value</a><br/><br>
																	<?php } ?>
		<?php if(!isset($_REQUEST['BankAcc']) and !isset($_REQUEST['BrokerAcc'])) { ?>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Enter</button>
		<?php } ?>
	</form>
		<div class="title_Bill">
			<div class="content_Bill">
				<h3>Account actions:</h3>
			</div>
		</div>
		<?php 
			echo $page_obj->get_buttons(); // generating buttons
		?>
</div>
</body>	
</html>

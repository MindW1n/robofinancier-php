<?php  
	session_start();
	spl_autoload_register( function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once('../../connect.php');
	// new page object
	$page_obj = new ProfitPage();

	// generating header
	echo $page_obj->get_header();
?>
<body>
<?php
	// generating new financial work object
	$page_obj->set_new_financialWork_obj($pdo_obj, $_SESSION["email"]);

	if(isset($_REQUEST['income_BankAccount']) or isset($_REQUEST['income_BrokerageAccount']))
	{
		$income_BankAccount      = $_REQUEST['income_BankAccount'];
		$income_BrokerageAccount = $_REQUEST['income_BrokerageAccount'];
		$args = [$pdo_obj, $_SESSION['email'], 0, 0, 0, 0, 0, 0, 0, $income_BankAccount, $income_BrokerageAccount];
		$page_obj->do_financial_work($args);
	}
	?>
<body>
	<?php 
		// getting username
		echo $page_obj->get_username();
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>State of an account</h3>
		</div>
	</div>
	<?php 
		// generating financial content
		echo $page_obj->get_financial_content();	
	?>
	 <div>
			<?php if(!isset($_REQUEST['income_BankAccount']) and !isset($_REQUEST['income_BrokerageAccount'])) {?>
		<form method="POST" class="form-signin">
			<h2 class="title_Bill" style="color:white;">Enter income on deposit and brokerage account</h2>
			<?php 
				// generating inputs
				echo $page_obj->get_inputs();
			} ?>
			<?php if(!isset($_REQUEST['income_BankAccount']) and !isset($_REQUEST['income_BrokerageAccount'])) {?>
			<button class="btn-lg btn-primary btn-block btn" id="btn__register">Enter</button>
			<?php }?>
			</form>
		 <div class="title_Bill">
			<div class="content_Bill">
				<h3>Account actions:</h3>
			</div>
		</div>
		<?php if(isset($_REQUEST['income_BankAccount']) or isset($_REQUEST['income_BrokerageAccount'])) {?>
		<a href="profit.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Enter new value</a><br>
		<?php } 
			// generating links
			echo $page_obj->get_buttons();
		?>
	</div>
</body>
</html>
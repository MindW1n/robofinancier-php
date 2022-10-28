<?php 
	session_start();
	spl_autoload_register(function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once("../../connect.php");
	$page_obj = new FinancialWorkPage(); 
?>
<body>
	<?php 
		// generating header
		echo $page_obj->get_header(); 
		echo $page_obj->get_username(); 
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>State of an account</h3>
		</div>
	</div>
	<?php
		// generating financial info
		$page_obj->set_new_financialWork_obj($pdo_obj, $_SESSION["email"]);
		echo $page_obj->get_financial_content(); 
	?><br />
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>Account actions:</h3>
		</div>
	</div>
	<?php echo $page_obj->get_buttons(); // generating links ?>
</body>
</html>
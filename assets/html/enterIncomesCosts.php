<?php 
	session_start(); 
	spl_autoload_register( function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once('../../connect.php');
	// new page object
	$page_obj = new EnterIncomesCostsPage();

	// generating header
	echo $page_obj->get_header();
?>
<body>
<?php
	echo $page_obj->get_username();

	// generating new financial work object
	$page_obj->set_new_financialWork_obj($pdo_obj, $_SESSION["email"]);

	if(isset($_REQUEST['income']) or isset($_REQUEST['cost']))
	{
		$income = $_REQUEST['income'];
		$FirstDream_cost = $_REQUEST['FirstDreamCost'];
		$SecondDream_cost = $_REQUEST['SecondDreamCost'];
		$SafetyBag_cost = $_REQUEST['SafetyBagCost'];
		$CashFree_cost = $_REQUEST['FreeCashCost'];
		$args = [$pdo_obj, $_SESSION['email'], $income, $SafetyBag_cost, $FirstDream_cost, $SecondDream_cost, $CashFree_cost, 0, 0, 0, 0];
		$page_obj->do_financial_work($args);
	}
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
		<?php if(!isset($_REQUEST['income']) and !isset($_REQUEST['cost'])) {?>
	<form method="POST" class="form-signin">
		<h2 class="title_Bill" style="color:white;">Enter Incomes and Costs</h2>
		<?php
			// generating inputs
			echo $page_obj->get_inputs();
			} ?>
		<?php if(!isset($_REQUEST['income']) and !isset($_REQUEST['cost'])) {?>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Enter</button>
		<?php }?>
		</form>
		<div class="title_Bill">
			<div class="content_Bill">
				<h3>Account actions:</h3>
			</div>
		</div>
		<?php 
			//generating buttons
			echo $page_obj->get_buttons(); 
		?>
	</div>
</body>
</html>
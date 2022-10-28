<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>Enter Incomes and Costs</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username']?></h2>
	<?php 
		require_once('connect.php');
		spl_autoload_register( function($classname){ require_once "$classname" . "Class.php";});
		if(isset($_REQUEST['income']) or isset($_REQUEST['cost']))
		{
			$income = $_REQUEST['income'];
			$FirstDream_cost = $_REQUEST['FirstDreamCost'];
			$SecondDream_cost = $_REQUEST['SecondDreamCost'];
			$SafetyBag_cost = $_REQUEST['SafetyBagCost'];
			$CashFree_cost = $_REQUEST['FreeCashCost'];
			$obj = new FinancialWork($income, $SafetyBag_cost, $FirstDream_cost, $SecondDream_cost, $CashFree_cost, 0, 0, 0, 0, $PDO, $_SESSION['email']);
			$obj->cash_FirstDream_less();
			$obj->cash_SecondDream_less();
			$obj->cash_SafetyBag_less();
			$obj->cash_free_less();
			$obj->profit();
			$obj->loss();
			$obj->datebase_update();
		}
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>State of an account</h3>
		</div>
	</div>
	<?php 
		spl_autoload_register( function($classname){ require_once "$classname" . "Class.php";});
		require_once('connect.php');
		$obj = new FinancialWork(0, 0, 0, 0, 0, 0, 0, 0, 0, $PDO, $_SESSION['email']);
		$cash = $obj->get_cash();
		$put_BankAccount = $obj->get_put_BankAccount();
		$cash_free = $obj->get_cash_free();
		$put_BrokerAccount = $obj->get_put_BrokerAccount();
		$cash_SafetyBag = $obj->get_cash_Safetybag();
		$cash_BankAccount = $obj->get_cash_BankAccount();
		$cash_BrokerAccount = $obj->get_cash_BrokerAccount();
		$cash_FirstDream = $obj->get_cash_FirstDream();
		$cash_SecondDream = $obj->get_cash_SecondDream();
		$cash_SafetyBag = $obj->get_cash_SafetyBag();
		$percent_SafetyBag = $obj->get_percent_SafetyBag();
		$percent_FirstDream = $obj->get_percent_FirstDream();
		$percent_SecondDream = $obj->get_percent_SecondDream();
		echo "There are " . $cash . " roubles on your account. <br/>";
		echo "There are " . $cash_BankAccount . " roubles on your bank account. <br/>";
		echo "There are " . $cash_BrokerAccount . " roubles on your broker account. <br/>";
		echo "There are " . $cash_FirstDream . " roubles for your first dream. <br/>";
		echo "There are " . $cash_SecondDream . " roubles for your second dream. <br/>";
		echo "There are " . $cash_SafetyBag . " roubles for your safety bag. <br/>";
		echo "You need to put on the brokerage account " . $put_BrokerAccount . " roubles. <br/>";
		echo "You need to put on the deposit " . $put_BankAccount . " roubles. <br/>";
		echo "And this money can be safely spent: " . $cash_free . " roubles. <br/>";
		echo "The first dream is " . $percent_FirstDream . " percent of the bank account<br/>";
		echo "The second dream is " . $percent_SecondDream . " percent of the bank account<br/>";
		echo "The safety bag is " . $percent_SafetyBag . " percent of the bank account<br/>";
	 ?>
	<div>
		<?php if(!isset($_REQUEST['income']) and !isset($_REQUEST['cost'])) {?>
	<form method="POST" class="form-signin">
		<h2 class="title_Bill" style="color:white;">Enter Incomes and Costs</h2>
		<input type="text" name="income" class="form-control" placeholder="
Enter income">
		<input type="text" name="FirstDreamCost" class="form-control" placeholder="Enter first dream cost">
		<input type="text" name="SecondDreamCost" class="form-control" placeholder="Enter second dream cost">
		<input type="text" name="SafetyBagCost" class="form-control" placeholder="Enter safety bag cost">
		<input type="text" name="FreeCashCost" class="form-control" placeholder="Enter free cash cost">
		<?php } ?>
		<?php if(!isset($_REQUEST['income']) and !isset($_REQUEST['cost'])) {?>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Enter</button>
		<?php }?>
		</form>
		<div class="title_Bill">
			<div class="content_Bill">
				<h3>Account actions:</h3>
			</div>
		</div>
		<a href="PutOnAccounts.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Put on accounts</a>
		<a href="Profit.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Enter income on deposit and brokerage account</a>
		<a href="viewRecords.php" class="btn-lg btn-primary btn-block btn" id="btn__register">
View records</a><br><br>
		<a href="logout.php" class="btn-lg btn-primary btn-block btn">Logout</a><br><br>
	</div>
</body>
</html>
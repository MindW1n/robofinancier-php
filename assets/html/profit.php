<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>Profit</title>
</head>
<body>
	<?php 
		spl_autoload_register( function($classname){ require_once "$classname" . "Class.php";});
	 	require_once('connect.php');
		if(isset($_REQUEST['income_BankAccount']) or isset($_REQUEST['income_BrokerageAccount']))
		{
			$income_BankAccount      = $_REQUEST['income_BankAccount'];
			$income_BrokerageAccount = $_REQUEST['income_BrokerageAccount'];
			$obj = new FinancialWork(0, 0, 0, 0, 0, 0, 0, $income_BankAccount, $income_BrokerageAccount, $PDO, $_SESSION['email']);
			$obj->BankAccount_profit();
			$obj->BrokerageAccount_profit();
			$obj->datebase_update();
		}
	?>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username']?></h2>
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
			<?php if(!isset($_REQUEST['income_BankAccount']) and !isset($_REQUEST['income_BrokerageAccount'])) {?>
		<form method="POST" class="form-signin">
			<h2 class="title_Bill" style="color:white;">Enter income on deposit and brokerage account</h2>
			<input type="text" name="income_BankAccount" class="form-control" placeholder="Enter income on deposit">
			<input type="text" name="income_BrokerageAccount" class="form-control" placeholder="Enter income on brokerage account">
			<?php } ?>
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
		<a href="profit.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Enter new value</a><br><br>
		<?php } ?>
		<a href="PutOnAccounts.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Put on accounts</a>
		<a href="EnterIncomesCosts.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Enter incomes and costs</a>
		<a href="viewRecords.php" class="btn-lg btn-primary btn-block btn" id="btn__register">
View records</a><br><br><br><br>
		<a href="logout.php" class="btn-lg btn-primary btn-block btn">Logout</a><br><br>
	</div>
</body>
</html>
<?php  
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>View records</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username']?></h2>
	<a href="FinancialWork.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a>
	<a href="makeARecord.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Make a record</a>
	<a href="viewRecordsIncomes.php" class="btn-lg btn-primary btn-block btn" id="btn__register">View records about incomes</a>
	<a href="viewRecordsCosts.php" class="btn-lg btn-primary btn-block btn" id="btn__register">View records about costs</a>
	<a href="statistics.php" class="btn-lg btn-primary btn-block btn" id="btn__register">View statistics</a>
	<br/><br/>
	
</body>
</html>
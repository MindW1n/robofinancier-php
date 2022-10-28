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
	<title>Statistics</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username'];?></h2>
	<?php 
		spl_autoload_register( function($classname){ require_once "$classname" . "Class.php";});
		require_once "connect.php";
		if(!(isset($_REQUEST['year']) or isset($_REQUEST['flag'])) or $_REQUEST["year"] == "" and !isset($_REQUEST["flag"]))
		{
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h2>Statistics</h2>
		</div>
	</div><br><br>
	<form method="POST">
		<h4>Enter the statistics year:</h4><br>
		<input type="input" name="year" placeholder="Year"><br><br>
		<input type="checkbox" name="flag" id="flag">
		<label for="flag">Do you want to see statistics for all time?</label><br>
		<a href="viewRecords.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Show statistics</button>
	</form>
	<?php 
		}
		else
		{
			if(isset($_REQUEST['year']))
			{
				$year = $_REQUEST['year'];
			}
			$year = isset($_REQUEST['flag']) ? False : $year;	
			?>
				<a href="statistics.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a><br>
				<img src="image.png" alt=""><br>
			<?php
		} 
	?>
</body>
</html>
<?php  
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<title>View records</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><?php echo $_SESSION['username']?></h2>
	<a href="viewRecords.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a><br/><br/>
	<?php  
		if(isset($_POST['year']))
		{
			$year = $_POST['year'];
			if(isset($_POST['flag']))
			{
				$flag = 1;
			}
			else
			{
				$flag = 0;
			}
			if($flag === 1)
			{
				echo "<h2>All records about incomes:</h2>";
			}
			else if($flag === 0)
			{
				echo "<h2>All records about incomes for " . $year . ":</h2>";
			}
			spl_autoload_register(function($classname){ require_once "../../classes/$classname" . "Class.php";});
		 	require_once('../../connect.php');
		 	$records_obj = new ViewRecords($pdo_obj, $year, $flag);
		 	echo $records_obj->get_content_incomes();
		}
		else
		{ ?>
			<br><form method="POST">
				<input type="number" name='year' placeholder="Enter the year of records"><br><br>
				<input type="checkbox" name="flag" id="flag">
				<label for="flag">Do you want to watch the all records?</label><br>
				<button class="btn-lg btn-primary btn-block btn" id="btn__register">Show records</button>
			</form>
		<?php }
	?>
</body>
</html>
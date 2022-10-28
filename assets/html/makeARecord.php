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
	<title>Make a record</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username']?></h2>
	<?php  
		spl_autoload_register(function($classname){ require_once "$classname" . "Class.php";});
	 	require_once('connect.php');

		if(isset($_REQUEST['date']) 
			and isset($_REQUEST['sum']) 
			and isset($_REQUEST['record']) 
			and isset($_REQUEST['categories'])
			and isset($_REQUEST['type']))
		{
			$date = $_REQUEST['date'];
			$sum = $_REQUEST['sum'];
			$record = preg_replace("/\\'/", "Apostrophe", $_REQUEST['record']);
			$category = $_REQUEST['categories'];
			$type = $_REQUEST['type'];
			$author_id = $_SESSION['author_id'];
			$makeARecord_obj = new MakeARecord($sum, $record, $category, $type, $date, $author_id, $PDO);
			$result = $makeARecord_obj->make_a_record();
			$ssmsg = "Record created successfully!";
			$flsmsg = "Something went wrong :(";
			if($result === 1) 
			{?> 
				<div class="alert alert-success form-signin" role="alert" width=30>
					<h3>
						<? echo $ssmsg; ?>
					</h3>
				</div><br>
			<?} 
			if ($result === 0) 
			{?> 
				<div class="alert alert-danger form-signin" role="alert">
					<h3>
						<? echo $flsmsg; ?>
					</h3>
				</div><br> 
			<?}
		}
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h2>Make a record</h2>
		</div>
	</div><br><br>
	<form method="POST">
		<h4>Enter record date:</h4><br>
		<input type="date" name="date" required><br><br>
		<h4>Enter sum of record:</h4><br>
		<input type="text" name="sum" placeholder="Sum" required><br><br>
		<h4>Enter the record:</h4><br>
		<textarea name="record" placeholder="Record..." required></textarea><br><br>
		<h4>Enter record category:</h4><br>
  		<select name="categories" required>
  			<optgroup label="Income type">
  			<?php 
  				$categories_obj = new Categories($PDO);
  				foreach ($categories_obj->get_categories("income") as $value)
  				{
  					echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
  				}
  			?>
  			<optgroup label="Cost type">
  			<?php 
  				$categories_obj = new Categories($PDO);
  				foreach ($categories_obj->get_categories("cost") as $value)
  				{
  					echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
  				}
  			?>	
  		</select><br>
  		<a href="addCategory.php" class="btn-lg btn-primary btn-block btn" id="btn__register"><h6>Add category</h6></a><br><br>
		<h4>Enter type of record:</h4><br>
		<input type="radio" name="type" id="income" value="income">
    		<label for="income">Income</label>   
    	<input type="radio" name="type" id="cost" value="cost">
    		<label for="cost">Cost</label>
    	<br><br><button class="btn-lg btn-primary btn-block btn" id="btn__register">Create a record</button><br>
    	<a href="viewRecords.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a><br/><br/>
	</form>
</body>
</html>
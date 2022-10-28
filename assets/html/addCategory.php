<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>Add category</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username']?></h2>
	<div class="title_Bill">
		<div class="content_Bill">
			<h2>Add category</h2>
		</div>
	</div><br><br>
	<?php 
		spl_autoload_register(function($classname){ require_once "$classname" . "Class.php";});
	 	require_once('connect.php');

		if(isset($_REQUEST['type']) and isset($_REQUEST['name']))
		{
			$type = $_POST['type'];
			$name = $_POST['name'];
			$category_obj = new Categories($PDO);
			$result = $category_obj->add_category($name, $type);
			$ssmsg = "Category added successfully";
			$flsmsg = "Something went wrong";
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
	<form action="" method="POST">
		<h4>Enter category name:</h4><br>
		<input type="text" placeholder="Category name" name="name"><br><br>
		<h4>Enter category type:</h4><br>
		<select  name="type" id="type">
			<option value="income" id="type">income</option>
			<option value="cost" id="type">cost</option>
		</select><br><br>
		<a href="makeARecord.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a>
		<button type="submit" class="btn-lg btn-primary btn-block btn" id="btn__register">Add</button>
	</form>
</body>
</html>
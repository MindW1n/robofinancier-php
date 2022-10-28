<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>View tasks</title>
</head>
<body>
	<?php  
		spl_autoload_register( function($classname){ require_once "$classname" . "Class.php";});
		require_once "connect.php";
		echo '<a href="FinancialWork.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back to financial work</a>      
		<a href="setTask.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Set a task</a><br><br>';
		$viewTasksObj = new TasksPage($_SESSION['author_id'], $PDO);
		$tasks = $viewTasksObj->get_tasks();
	?>
	<form method="POST">
		<fieldset>
		    <legend>Select the tasks you want to complete:</legend>
		    <?php  
		    	if (!empty($_POST))
		    	{
		    		$viewTasksObj->rmTask($_POST);
		    		$tasks = $viewTasksObj->get_tasks();
		    	}
		    	foreach ($tasks as $value) { ?>
		    		<div>
				   		<input type="checkbox" id="<?=$value[0]?>" name="<?=$value[0]?>">
				    	<label for="<?=$value[0]?>"><?=$value[1]?></label>
		   			</div>
		    	<?php }
		    ?>

		</fieldset>
		<button class="btn btn-primary btn-block btn-lg" id='btn__register'>Complete selected tasks</button>
	</form>
</body>
</html>
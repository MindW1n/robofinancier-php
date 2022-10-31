<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<title>Set a task</title>
</head>
<body>
	<?php
		spl_autoload_register( function($classname){ require_once "../../classes/$classname" . "Class.php";});
		require_once "../../connect.php";
		if (!$_POST['task'])
		{
	?>
	<form method="POST">
		<textarea name="task" placeholder="Type your task:"></textarea><br>
		<input type="submit" name="Submit" class="btn-lg btn-primary btn-block btn" id="btn__register" value="Submit">
	</form>
	<?php 
		}
		else
		{
			$viewTasksObj = new TasksPage($_SESSION['author_id'], $pdo_obj);
			$result = $viewTasksObj->setTask($_POST['task']);
			if ($result)
			{?>
				<div class="form-signin"><div class="alert alert-success" role="alert"><h3>Your task has been created successfully!</h3></div></div>
				<a href="setTask.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Another one</a><br>
			<?php }
			else
			{?>
				<div class="form-signin"></div><div class="alert alert-danger" role="alert"><h3>Something went wrong! Sorry!</h3></div></div>
			<?php }
		}
	?>
<a href="viewTasks.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Go back</a>
</body>
</html>
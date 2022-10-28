<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>//title</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><? echo $_SESSION['username']?></h2>
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>State of an account</h3>
		</div>
	</div>
	//output
	<div class="title_Bill">
		<div class="content_Bill">
			<h3>Account actions:</h3>
		</div>
	</div>
	//buttons
</body>
</html>
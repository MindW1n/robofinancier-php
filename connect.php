<?php 
	try
	{
		$pdo_obj = new PDO("mysql:host=localhost;dbname=robofinancierdatebase", "root", "");
	}
	catch(PDOException $e)
	{
		echo "Date base connection error: $e";
	}
?>
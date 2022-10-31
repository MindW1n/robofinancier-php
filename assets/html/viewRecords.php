<?php  
	session_start();
	spl_autoload_register(function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once("../../connect.php");
	$page_obj = new ViewRecordsPage(); 

	// generating header
	echo $page_obj->get_header();
?>
<body>
	<?php 
		// getting username
		echo $page_obj->get_username();
		// generating buttons
		echo $page_obj->get_buttons();
	?>
</body>
</html>
<?php  
	class RegistrationPage extends Page
	{
		public function __construct()
		{
			$this->title = "Registration";
			$this->inputs[] = ["username", "Username"];
			$this->inputs[] = ["email", "Email"];
			$this->inputs[] = ["password", "Password"];
			$this->buttons[] = ["../../index.php", "Login"];
		}
	}
?>
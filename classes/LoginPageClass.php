<?php 
	class LoginPage extends Page
	{
		private $email;
		private $password;
		private $pdo_obj;

		public function __construct($email = "", $password = "", PDO $PDO = null)
		{
			$this->email = $email;
			$this->password = $password;
			$this->pdo_obj = $PDO;
		}

		public function check_password()
		{
			try
			{
				$query = "SELECT * FROM users WHERE email='$this->email' and password='$this->password'";
				$raw = $this->pdo_obj->query($query);
				$result = $raw->fetch();
				if(isset($result['id']))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}
		}
		public function get_username()
		{
			try 
			{
				$query = "SELECT * FROM users WHERE email='$this->email' and password='$this->password'";
				$raw = $this->pdo_obj->query($query);
				$result = $raw->fetch();
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}
			return $result['username'];
		}
		public function get_id()
		{
			try 
			{
				$query = "SELECT * FROM users WHERE email='$this->email' and password='$this->password'";
				$raw = $this->pdo_obj->query($query);
				$result = $raw->fetch();
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}
			return $result['id'];
		}
	}
?>
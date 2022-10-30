<?php 
	class Registration
	{
		private $email;
		private $username;
		private $password;
		private $pdo_obj;
		public function __construct($email, $username, $password, PDO $pdo)
		{
			$this->email = $email;
			$this->username = $username;
			$this->password = $password;
			$this->pdo_obj = $pdo;
		}
		public function register_user()
		{
			try 
			{
				$query = "INSERT INTO users(email, password, username) VALUES('$this->email', '$this->password', '$this->username')";
				$this->pdo_obj->exec($query);
				return 1;
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
				return 0;
			}
		}
		public function check_user_existence()
		{
			try
			{
				$query = "SELECT * FROM users WHERE email='$this->email'";
				$raw = $this->pdo_obj->query($query);
				$result = $raw->fetch();
				if(isset($result['id']))
				{
				 	$email_existence = 1;
				}
				else
				{
					$email_existence = 0;
				}
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}

			try
			{
				$query = "SELECT * FROM users WHERE username='$this->username'";
				$raw = $this->pdo_obj->query($query);
				$result = $raw->fetch();
				if(isset($result['id']))
				{
				 	$username_existence = 1;
				}
				else
				{
					$username_existence = 0;
				}
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}

			if($username_existence === 1 or $email_existence === 1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
?>
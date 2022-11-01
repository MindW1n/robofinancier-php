<?php 
	session_start();

	class FinancialWork extends Page
	{
		private $cash;
		private $income;
		private $income_BankAccount;
		private $income_BrokerageAccount;
		private $costs_FirstDream;
		private $costs_SecondDream;
		private $costs_free;
		private $costs_SafetyBag;
		private $cash_BrokerAccount;
		private $cash_BankAccount;
		private $put_BankAccount_less;
		private $put_BrokerAccount_less;
		private $cash_free;
		private $cash_FirstDream; 
		private $cash_SecondDream;
		private $cash_SafetyBag;
		private $put_BrokerAccount;
		private $put_BankAccount;
		private $percent_SafetyBag;
		private $percent_FirstDream;
		private $percent_SecondDream;
		private $pdo_obj;
		private $email;
		
		public function __construct(PDO $connection, $email, $income = 0, $costs_SafetyBag = 0,  $costs_FirstDream = 0, $costs_SecondDream = 0, $costs_free = 0, $put_BrokerAccount_less = 0, $put_BankAccount_less = 0, $income_BankAccount = 0, $income_BrokerageAccount = 0)
		{
			$this->email                   = $email;
			$this->pdo_obj                 = $connection;
			$this->income                  = $income;
			$this->costs_SafetyBag         = $costs_SafetyBag;
			$this->costs_FirstDream        = $costs_FirstDream;
			$this->costs_SecondDream       = $costs_SecondDream;
			$this->costs_free              = $costs_free;
			$this->put_BankAccount_less   = $put_BankAccount_less;
			$this->put_BrokerAccount_less = $put_BrokerAccount_less;
			$this->income_BankAccount      = $income_BankAccount;
			$this->income_BrokerageAccount = $income_BrokerageAccount;

			try 
			{
				$query  = "SELECT * FROM users WHERE email='$this->email'";
				$raw    = $this->pdo_obj->query($query);
				$result = $raw->fetch();
				$this->cash_BrokerAccount  = $result['cash_BrokerAccount'];
				$this->cash_BankAccount    = $result['cash_BankAccount'];
				$this->cash_free           = $result['cash_free'];
				$this->cash_SafetyBag      = $result['cash_SafetyBag'];
				$this->cash_FirstDream     = $result['cash_FirstDream'];
				$this->cash_SecondDream    = $result['cash_SecondDream'];
				$this->put_BrokerAccount   = $result['put_BrokerAccount'];
				$this->put_BankAccount     = $result['put_BankAccount'];
				$this->cash                = $result['cash'];
				$this->percent_SafetyBag   = $result['percent_SafetyBag'];
				$this->percent_FirstDream  = $result['percent_FirstDream'];
				$this->percent_SecondDream = $result['percent_SecondDream'];
			}

			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}

		}

		public function set_properties(array $args)
		{
			for($i = 0; $i < count($args); $i++) {

				if($args[0][$i] === "") $args[0][$i] = 0;
			}
			$variables_names = ["connection", "email", "income", "costs_SafetyBag",  "costs_FirstDream", "costs_SecondDream", "costs_free", "put_BrokerAccount_less", "put_BankAccount_less", "income_BankAccount",  "income_BrokerageAccount"];
			for($i = 0; $i < count($args[0]); $i++) {
				$string = $variables_names[$i];
				$this->$string = $args[0][$i];
			}
		}

		public function profit()
		{
			$this->cash              += (double)$this->income;
			$this->cash_free         += (double)$this->income * 0.1;
			$this->put_BrokerAccount += (double)$this->income * 0.375;
			$this->put_BankAccount   += (double)$this->income * 0.525;
		}

		public function BankAccount_profit()
		{
			$this->cash             += (double)$this->income_BankAccount;
			$this->cash_BankAccount += (double)$this->income_BankAccount;
			$this->cash_FirstDream  += round((double)$this->income_BankAccount / 100 * 38.095239, 2);
			$this->cash_SecondDream += round((double)$this->income_BankAccount / 100 * 38.095238, 2);
			$this->cash_SafetyBag   += round((double)$this->income_BankAccount / 100 * 23.809523, 2);
			$this->percent_SafetyBag = (double)$this->cash_SafetyBag / (double)$this->cash_BankAccount * 100;
			$this->percent_FirstDream = (double)$this->cash_FirstDream / (double)$this->cash_BankAccount * 100;
			$this->percent_SecondDream = (double)$this->cash_SecondDream / (double)$this->cash_BankAccount * 100;
		}

		public function BrokerageAccount_profit()
		{
			$this->cash               += (double)$this->income_BrokerageAccount;
			$this->cash_BrokerAccount += (double)$this->income_BrokerageAccount;
		}

		public function loss()
		{
			$this->cash -= (double)$this->costs_SafetyBag + (double)$this->costs_FirstDream + (double)$this->costs_SecondDream + (double)$this->costs_free;
		}

		public function __call($methodname, $args)
		{
			$methodname = substr($methodname, 4);
			return $this->$methodname;
		}

		public function put_on_BrokerAccount()
		{
			$this->put_BrokerAccount -= (double)$this->put_BrokerAccount_less;
			$this->cash_BrokerAccount += (double)$this->put_BrokerAccount_less;
		}

		public function calculate_percents()
		{
			if($this->cash_BankAccount != 0) {
				$this->percent_SafetyBag = (double)$this->cash_SafetyBag / (double)$this->cash_BankAccount * 100;
				$this->percent_FirstDream = (double)$this->cash_FirstDream / (double)$this->cash_BankAccount * 100;
				$this->percent_SecondDream = (double)$this->cash_SecondDream / (double)$this->cash_BankAccount * 100;
			}
		}

		public function put_on_BankAccount()
		{
			$this->put_BankAccount -= (double)$this->put_BankAccount_less;
			$this->cash_BankAccount += (double)$this->put_BankAccount_less;
			$this->cash_FirstDream   += round((double)$this->put_BankAccount_less * 38.095239 / 100, 2);
			$this->cash_SecondDream  += round((double)$this->put_BankAccount_less * 38.095238 / 100, 2);
			$this->cash_SafetyBag    += round((double)$this->put_BankAccount_less * 23.809523 / 100, 2);
			$this->calculate_percents();
		}

		public function cash_FirstDream_less()
		{
			$this->cash_FirstDream -= (double)$this->costs_FirstDream; 
			$this->cash_BankAccount -= (double)$this->costs_FirstDream;
			$this->calculate_percents();
		}

		public function cash_SecondDream_less()
		{
			$this->cash_SecondDream -= (double)$this->costs_SecondDream;
			$this->cash_BankAccount -= (double)$this->costs_SecondDream;
			$this->calculate_percents();
		}

		public function cash_free_less()
		{
			$this->cash_free -= (double)$this->costs_free;
		}

		public function cash_SafetyBag_less()
		{
			$this->cash_SafetyBag -= (double)$this->costs_SafetyBag;
			$this->cash_BankAccount -= (double)$this->costs_SafetyBag;
			$this->calculate_percents();
		}

		public function database_update()
		{
			try 
			{
				$this->pdo_obj->exec("UPDATE users SET cash=$this->cash WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET cash_BankAccount=$this->cash_BankAccount WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET cash_BrokerAccount=$this->cash_BrokerAccount WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET cash_free=$this->cash_free WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET cash_SafetyBag=$this->cash_SafetyBag WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET cash_FirstDream=$this->cash_FirstDream WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET cash_SecondDream=$this->cash_SecondDream WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET put_BrokerAccount=$this->put_BrokerAccount WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET put_BankAccount=$this->put_BankAccount WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET percent_SafetyBag=$this->percent_SafetyBag WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET percent_FirstDream=$this->percent_FirstDream WHERE email='$this->email'");
				$this->pdo_obj->exec("UPDATE users SET percent_SecondDream=$this->percent_SecondDream WHERE email='$this->email'");
				$this->database_dump();
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}
		}

		private function database_dump()
		{
			try
			{
				$query = "SELECT * FROM users WHERE email='$this->email'";
				$raw    = $this->pdo_obj->query($query);
				$result = $raw->fetch();
				$string  = "\n";
				$string .= $result['id'] . " ";
				$string .= $result['username'] . " ";
				$string .= $result['cash'] . " ";
				$string .= $result['cash_BrokerAccount'] . " ";
				$string .= $result['cash_BankAccount'] . " ";
				$string .= $result['cash_free'] . " ";
				$string .= $result['cash_SafetyBag'] . " ";
				$string .= $result['cash_FirstDream'] . " ";
				$string .= $result['cash_SecondDream'] . " ";
				$string .= $result['put_BrokerAccount'] . " ";
				$string .= $result['put_BankAccount'] . " ";
				$string .= $result['percent_SafetyBag'] . " ";
				$string .= $result['percent_FirstDream'] . " ";
				$string .= $result['percent_FirstDream']. " \n";
				$query = "SELECT id FROM users WHERE email='$this->email'";
				$raw = $this->pdo_obj->query($query);
				$author_id = $raw->fetch()['id'];
				$query = "INSERT INTO history(author_id, cash, cash_BrokerAccount, cash_BankAccount, cash_free, cash_SafetyBag, cash_FirstDream, cash_SecondDream, put_BrokerAccount, put_BankAccount, percent_SafetyBag, percent_FirstDream, percent_SecondDream) VALUES('$author_id', '$this->cash', '$this->cash_BrokerAccount', '$this->cash_BankAccount', '$this->cash_free', '$this->cash_SafetyBag', '$this->cash_FirstDream', '$this->cash_SecondDream', '$this->put_BrokerAccount', '$this->put_BankAccount', '$this->percent_SafetyBag', '$this->percent_FirstDream', '$this->percent_SecondDream')";
				$this->pdo_obj->exec($query);
			}

			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
			}
		}
	}
?>
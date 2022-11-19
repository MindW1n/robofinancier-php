<?php  

	// Now I'm gonna try to remember how the Singleton works
	class Settings
	{
		private static $settings_object;
		private $cash_free_percent;
		private $brokerAccount_percent;
		private $firstDream_percent;
		private $secondDream_percent;
		private $safetyBag_percent;
		private $bankAccount_percent;
		private $bankAccount_firstDream_proportion;
		private $bankAccount_secondDream_proportion;
		private $bankAccount_safetyBag_proportion;
		private $firstDream_proportion;
		private $secondDream_proportion;
		private $safetyBag_proportions;
		private $pdo_obj;

		private function __construct($pdo_obj)
		{
			$this->pdo_obj = $pdo_obj;
			$author_id = $_SESSION['author_id'];
			try 
			{
				$query  = "SELECT * FROM options where author_id = $author_id";
				$raw    = $this->pdo_obj->query($query);
				$result = $raw->fetch();
				if(empty($result)) {

					throw new Exception("You don't have settings for your account! Would you like to create 'em?");
				}
				$this->cash_free_percent = $result["cash_free_percent"];
				$this->brokerAccount_percent = $result["brokerAccount_percent"];
				$this->firstDream_percent = $result["firstDream_percent"];
				$this->secondDream_percent = $result["secondDream_percent"];
				$this->safetyBag_percent = $result["safetyBag_percent"];
				$this->bankAccount_percent = $this->firstDream_percent + $this->secondDream_percent
					+ $this->safetyBag_percent;
				$this->bankAccount_firstDream_proportion = $this->firstDream_percent / $this->bankAccount_percent * 100;
				$this->bankAccount_secondDream_proportion = $this->secondDream_percent / $this->bankAccount_percent * 100;
				$this->bankAccount_safetyBag_proportion = $this->safetyBag_percent / $this->bankAccount_percent * 100;
			}

			catch(PDOException $e)
			{
				echo "Caught the folowing pdo error: " . $e;
			}
		}

		public static function get_settings_obj($pdo_obj)
		{
			if(empty($settings_object)) {

				self::$settings_object = new self($pdo_obj);
			}
			return self::$settings_object;
		}

		public function set_properties($cash_free_percent, $brokerAccount_percent, 
			$firstDream_percent, $secondDream_percent, $safetyBag_percent)
		{
			if($cash_free_percent + $brokerAccount_percent + $firstDream_percent 
				+ $secondDream_percent + $safetyBag_percent != 100) {

				throw new Exception("The sum of percents you've passed isn't 100!");
				return;
			}
			$this->cash_free_percent = $cash_free_percent;
			$this->brokerAccount_percent = $brokerAccount_percent;
			$this->firstDream_percent = $firstDream_percent;
			$this->secondDream_percent = $secondDream_percent;
			$this->safetyBag_percent = $safetyBag_percent;
			$this->database_update();
			return 1;
		}

		public function __call($methodname, $args)
		{
			if(preg_match("/get_\S+/", $methodname)) {
			
				$var_name = substr($methodname, 4);
				return $this->$var_name;
			}
		}

		public function database_update()
		{
			try {

				$this->pdo_obj->exec("
					UPDATE options 
					SET cash_free_percent = $this->cash_free_percent,
						brokerAccount_percent = $this->brokerAccount_percent,
						firstDream_percent = $this->firstDream_percent,
						secondDream_percent = $this->secondDream_percent,
						safetyBag_percent = $this->safetyBag_percent
					WHERE author_id = " . $_SESSION['author_id'] 
									 );
			}
			catch(PDOException $error) {

				echo "Here's a problem with pdo: $error";
				return 0;
			}
		}

		public static function create_new_settings($pdo_obj)
		{
			$query = "INSERT INTO options(author_id, cash_free_percent, brokerAccount_percent, 
			firstDream_percent, secondDream_percent, safetyBag_percent) VALUES(" . $_SESSION['author_id'] . ", 1, 1, 1, 1, 1)";
			try {
				$pdo_obj->exec($query);
				return 1;
			}
			catch(PDOException $e)
			{
				echo "Caught the following error: $e";
				return 0;
			}
		}
	}
?>
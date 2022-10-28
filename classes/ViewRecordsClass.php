<?php  
	class ViewRecords extends Page
	{
		private $pdo_obj;
		private $content_incomes;
		private $content_costs;
		private $author_id;
		private $flag;
		private $year;

		public function __construct($pdo_obj, $year, $flag)
		{
			$this->author_id = $_SESSION['author_id'];
			$this->pdo_obj = $pdo_obj;
			$this->flag = $flag;
			$this->year = $year;
			try
			{
				if($flag === 0)
				{
					$query_incomes  = "SELECT date, sum, category, record FROM records WHERE author_id = '$this->author_id' and type = 'income' and date >= '$this->year-01-01' and date <= '$this->year-12-31' ORDER BY date DESC";
				}
				else if($flag === 1)
				{
					$query_incomes  = "SELECT date, sum, category, record FROM records WHERE author_id = '$this->author_id' and type = 'income' ORDER BY date DESC";
				}
				$raw_incomes    = $this->pdo_obj->query($query_incomes);
				$result_incomes = $raw_incomes->fetchall();
				$str_incomes = "";
				if(empty($result_incomes))
					$str_incomes .= "Your list of records about incomes is empty...";
				foreach($result_incomes as $key_incomes => $value_incomes)
				{
					if (is_array($value_incomes)){
						foreach ($value_incomes as $newkey_incomes => $newvalue_incomes) 
						{
							if(is_numeric($newkey_incomes))
							{
								if ($newkey_incomes == 0)
									$str_incomes .= "Date of record: " . $newvalue_incomes . "<br />";
								if ($newkey_incomes == 1)
									$str_incomes .= "Sum: " . $newvalue_incomes . "<br />";
								if ($newkey_incomes == 2)
									$str_incomes .= "Category: " . $newvalue_incomes . "<br />";
								if ($newkey_incomes == 3)
									$str_incomes .= "Record: " . preg_replace("/Apostrophe/", "'", $newvalue_incomes) . "<br />_____________________<br/>";
							}
						}
					}
					else if (is_numeric($key_incomes))
					{
						if ($newkey_incomes == 0)
							$str_incomes .= "Date of record: " . $newvalue_incomes . "<br />";
						if ($newkey_incomes == 1)
							$str_incomes .= "Sum: " . $newvalue_incomes . "<br />";
						if ($newkey_incomes == 2)
							$str_incomes .= "Category: " . $newvalue_incomes . "<br />";
						if ($newkey_incomes == 3)
							$str_incomes .= "Record: " . preg_replace("/Apostrophe/", "'", $newvalue_incomes) . "<br />_____________________<br/>";
					}
					else if(is_empty($key_incomes))
						$str_incomes .= "Your list of records about incomes is empty...";
				}
				if($flag === 0)
				{
					$query_costs  = "SELECT date, sum, category, record FROM records WHERE author_id = '$this->author_id' and type = 'cost' and date >= '$this->year-01-01' and date <= '$this->year-12-31' ORDER BY date DESC";
				}
				else if($flag === 1)
				{
					$query_costs  = "SELECT date, sum, category, record FROM records WHERE author_id = '$this->author_id' and type = 'cost' ORDER BY date DESC";
				}
				$raw_costs    = $this->pdo_obj->query($query_costs);
				$result_costs = $raw_costs->fetchall();
				$str_costs = "";
				if(empty($result_costs))
					$str_costs .= "Your list of records about costs is empty...";
				foreach ($result_costs as $key_costs => $value_costs)
				{
					if (is_array ($value_costs)){
						foreach ($value_costs as $newkey_costs => $newvalue_costs) 
						{
							if (is_numeric($newkey_costs))
							{
								if ($newkey_costs == 0)
									$str_costs .= "Date of record: " . $newvalue_costs . "<br />";
								if ($newkey_costs == 1)
									$str_costs .= "Sum: " . $newvalue_costs . "<br />";
								if ($newkey_costs == 2)
									$str_costs .= "Category: " . $newvalue_costs . "<br />";
								if ($newkey_costs == 3)
									$str_costs .= "Record: " . preg_replace("/Apostrophe/", "'", $newvalue_costs) . "<br />_____________________<br/>";
							}
						}
					}
					else if (is_numeric($key_costs))
					{
						if ($newkey_costs == 0)
							$str_costs .= "Date of record: " . $newvalue_costs . "<br />";
						if ($newkey_costs == 1)
							$str_costs .= "Sum: " . $newvalue_costs . "<br />";
						if ($newkey_costs == 2)
							$str_costs .= "Category: " . $newvalue_costs . "<br />";
						if ($newkey_costs == 3)
							$str_costs .= "Record: " . preg_replace("/Apostrophe/", "'", $newvalue_costs) . "<br />_____________________<br/>";
					}
				}
				$this->content_incomes = $str_incomes;
				$this->content_costs = $str_costs;
			}
			catch(PDOException $e)
			{
				echo "Cannot get info about records: $e";
			}
		}
		public function get_content_incomes()
		{
			return $this->content_incomes;
		}
		public function get_content_costs()
		{
			return $this->content_costs;
		}
	}
?>
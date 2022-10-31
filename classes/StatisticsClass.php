<?php  
	class Statistics
	{
		private $pdo_obj;
		private $year;
		private $id;

		public function __construct(PDO $pdo_obj, $id, $year = False)
		{
			$this->pdo_obj = $pdo_obj;
			$this->year = $year;
			$this->id = $id;
		}

		public function get_statistics()
		{
			if(!$this->year)
			{
				$query = "SELECT sum, type, category FROM records WHERE author_id = '$this->id'";
			}
			else
			{
				$query = "SELECT sum, type, category FROM records WHERE author_id = '$this->id' and date >= '$this->year-01-01' and date <= '$this->year-12-31'";
			}
			$raw = $this->pdo_obj->query($query);
			$result_array = $raw->fetchall();
			$incomes_array = $costs_array = array();
			$total = array();
			foreach ($result_array as $value) 
			{
				$array_type = str_replace("C", "c", (str_replace("I", "i", $value[1]))) . "s_array";
				eval("\$$array_type" . '[' . "\"$value[2]\"" . '][]' . " = $value[0];");
			} 
			$incomes_sum = 0;
			$costs_sum = 0;
			foreach ($incomes_array as $value) {
				foreach ($value as $sum) {
					$incomes_sum += $sum;
				}
			}
			foreach ($costs_array as $value) {
				foreach ($value as $sum) {
					$costs_sum += $sum;
				}
			}
			$incomes_percentages = $costs_percentages = array();
			foreach ($incomes_array as $key => $array)
			{
				$current_sum = 0;
				foreach ($array as $value)
				{
					$current_sum += $value;
				}
				$percentage = round($current_sum / $incomes_sum * 100, 1000);
				$incomes_percentages[$key] = [$current_sum, $percentage];
			}
			foreach ($costs_array as $key => $array)
			{
				$current_sum = 0;
				foreach ($array as $value)
				{
					$current_sum += $value;
				}
				$percentage = round($current_sum / $costs_sum * 100, 1000);
				$costs_percentages[$key] = [$current_sum, $percentage];
			}
			$total = ["incomes"     => $incomes_percentages,
					  "costs"       => $costs_percentages,
					  "incomes_sum" => $incomes_sum,
					  "costs_sum"   => $costs_sum];
			return $total;
		}
	}
?>
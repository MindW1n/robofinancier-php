<?php 
	class FinancialWorkPage extends Page
	{
		public $buttons = array();

		public function __construct()
		{
			$this->buttons[] = ["putOnAccounts.php", "Put on accounts"];
			$this->buttons[] = ["enterIncomesCosts.php", "Enter incomes and costs"];
			$this->buttons[] = ["profit.php", "Enter income on deposit and brokerage account"];
			$this->buttons[] = ["viewRecords.php", "View records"];
			$this->buttons[] = ["viewTasks.php", "View tasks"];
			$this->buttons[] = ["../../logout.php", "Logout"];
			$this->title = "RoboFinancier";
		}
	}
?>
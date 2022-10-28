<?php
	class PutOnAccountsPage extends Page
	{
		public function __construct()
		{
			$this->title = "Put";
			$this->inputs[] = ["BrokerAcc", "Broker account"];
			$this->inputs[] = ["BankAcc", "Bank account"];
			$this->buttons[] = ["enterIncomesCosts", "Enter incomes and costs"];
			$this->buttons[] = ["profit.php", "Enter income on deposit and brokerage account"];
			$this->buttons[] = ["viewRecords.php", "View records"];
			$this->buttons[] = ["../../logout.php", "Logout"];
			asdfdfad
		}
	}
?>
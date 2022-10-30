<?php
	class PutOnAccountsPage extends Page
	{
		public function __construct()
		{
			$this->title = "Put on accounts";
			$this->inputs[] = ["BrokerAcc", "Broker account"];
			$this->inputs[] = ["BankAcc", "Bank account"];
			$this->buttons[] = ["enterIncomesCosts.php", "Enter incomes and costs"];
			$this->buttons[] = ["profit.php", "Enter income on deposit and brokerage account"];
			$this->buttons[] = ["viewRecords.php", "View records"];
			$this->buttons[] = ["../../logout.php", "Logout"];
		}

		public function do_financial_work($args)
		{
			$this->financialWork_obj_set_properties($args);
			$this->financialWork_obj_put_on_BrokerAccount();
			$this->financialWork_obj_put_on_BankAccount();
			$this->financialWork_obj_database_update();
		}
	}
?>
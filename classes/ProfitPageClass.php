<?php  
	class ProfitPage extends Page
	{
		public function __construct()
		{
			$this->inputs[] = ["income_BankAccount", "Enter income on deposit"];
			$this->inputs[] = ["income_BrokerageAccount", "Enter income on brokerage account"];
			$this->buttons[] = ["putOnAccounts.php", "Put on accounts"];
			$this->buttons[] = ["enterIncomesCosts.php", "Enter incomes and costs"];
			$this->buttons[] = ["profit.php", "Enter income on deposit and brokerage account"];
			$this->buttons[] = ["viewRecords.php", "View records"];
			$this->buttons[] = ["viewTasks.php", "View tasks"];
			$this->buttons[] = ["settingsPage.php", "Set new options"];
			$this->buttons[] = ["../../logout.php", "Logout"];
		}

		public function do_financial_work($args)
		{
			$this->financialWork_obj_set_properties($args);
			$this->financialWork_obj_BankAccount_profit();
			$this->financialWork_obj_BrokerageAccount_profit();
			$this->financialWork_obj_database_update();
		}
	}
?>
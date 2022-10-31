<?php  
	class ProfitPage extends Page
	{
		public function __construct()
		{
			$this->inputs[] = ["income_BankAccount", "Enter income on deposit"];
			$this->inputs[] = ["income_BrokerageAccount", "Enter income on brokerage account"];
			$this->buttons[] = ["PutOnAccounts.php", "Put on accounts"];
			$this->buttons[] = ["EnterIncomesCosts.php", "Enter incomes and costs"];
			$this->buttons[] = ["viewRecords.php", "View records"];
			$this->buttons[] = ["../../logout.php", "Logout"];
		}

		public function do_financial_work($args)
		{
			$this->financialWork_obj_set_properties($args);
			print_r($args);
			$this->financialWork_obj_BankAccount_profit();
			$this->financialWork_obj_BrokerageAccount_profit();
			$this->financialWork_obj_database_update();
		}
	}
?>
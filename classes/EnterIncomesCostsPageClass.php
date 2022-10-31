<?php  
	class EnterIncomesCostsPage extends Page
	{
		public function __construct()
		{
			$this->title = "Enter incomes and costs";
			$this->buttons[] = ["putOnAccounts.php", "Put on accounts"];
			$this->buttons[] = ["profit.php", "Enter income on deposit and brokerage account"];
			$this->buttons[] = ["viewRecords.php", "View records"];
			$this->buttons[] = ["../../logout.php", "Logout"];
			$this->inputs[] = ["income", "Enter income"];
			$this->inputs[] = ["FirstDreamCost", "Enter first dream cost"];
			$this->inputs[] = ["SecondDreamCost", "Enter second dream cost"];
			$this->inputs[] = ["SafetyBagCost", "Enter safety bag cost"];
			$this->inputs[] = ["FreeCashCost", "Enter free cash cost"];
		}

		public function do_financial_work($args)
		{
			$this->financialWork_obj_set_properties($args);
			$this->financialWork_obj_cash_FirstDream_less();
			$this->financialWork_obj_cash_SecondDream_less();
			$this->financialWork_obj_cash_SafetyBag_less();
			$this->financialWork_obj_cash_free_less();
			$this->financialWork_obj_profit();
			$this->financialWork_obj_loss();
			$this->financialWork_obj_database_update();
		}
	}
?>
<?php  
	class ViewRecordsPage extends Page
	{
		public function __construct()
		{
			$this->title = "View records";
			$this->buttons[] = ["financialWork.php", "Back"];
			$this->buttons[] = ["makeARecord.php", "Make a record"];
			$this->buttons[] = ["viewRecordsIncomes.php", "View records about incomes"];
			$this->buttons[] = ["viewRecordsCosts.php", "View records about costs"];
			$this->buttons[] = ["statistics.php", "View statistics"];
		}
	}
?>
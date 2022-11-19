<?php
	class SettingsPage extends Page
	{
		public function __construct()
		{
			$this->inputs[] = ["cash_free_percent", "Enter your new cash free percent"];
			$this->inputs[] = ["brokerAccount_percent", "Enter new broker account percent"];
			$this->inputs[] = ["firstDream_percent", "Enter new first dream percent"];
			$this->inputs[] = ["secondDream_percent", "Enter new second dream percent"];
			$this->inputs[] = ["safetyBag_percent", "Enter new safety bag percent"];
			$this->buttons[] = ["financialWork.php", "Go to financial work!"];
		}
	}
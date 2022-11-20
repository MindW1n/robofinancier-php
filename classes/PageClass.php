<?php 
	session_start();

	abstract class Page
	{
		protected $title;
		protected $inputs = array();
		protected $buttons = array();
		private $financialWork_obj;

		public function __call($methodname, $args)
		{
			if(preg_match("/financialWork_obj\S+/", $methodname)) {
				$methodname = substr($methodname, 18);
				$this->financialWork_obj->$methodname($args);
			}
			else
			{
				echo "<br />Couldn't find method $methodname in financialWork_obj<br />";
			}
		}

		public function set_financial_properties(array $args)
		{
			$this->financialWork_obj->set_properties($args);
		}

		public function set_new_financialWork_obj($pdo_obj, $email)
		{
			$this->financialWork_obj = new FinancialWork($pdo_obj, $email);
		}

		public function get_buttons()
		{
			$string = "";
			for($i = 0; $i < count($this->buttons); $i++) {

				if($this->buttons[$i][1] == "Logout" and $i % 5 != 0) $string .= "<br />";
				$color = ($this->title == $this->buttons[$i][1]) ? "style = \"background-color: red;\"" : ""; 
				$string .= "<a href=\"" . $this->buttons[$i][0] . "\" $color class=\"btn-lg btn-primary btn-block btn\" id=\"btn__register\">" . $this->buttons[$i][1] . "</a>";
				if(($i + 1) % 5 == 0) $string .= "<br />";
			}
			return $string;
		}

		public function get_header()
		{
			$string = "";
			$string .= "<!DOCTYPE html>
						<html lang=\"en\">
						<head>
							<meta charset=\"UTF-8\">
							<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
							<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1\" crossorigin=\"anonymous\">
							<link rel=\"stylesheet\" href=\"../css/style.css\">
							<title>" . $this->title . "</title>
						</head>";

			return $string;
		}

		public function get_inputs()
		{
			$string = "";
			for($i = 0; $i < count($this->inputs); $i++) {

				$string .= "<input type=\"text\" name=\"".$this->inputs[$i][0] ."\" class=\"form-control\" placeholder=\"" .
$this->inputs[$i][1] . "\">  ";
			}
			$string .= "<br />";
			return $string;
		}

		public function get_username()
		{
			if(isset($_SESSION['username'])) {

				return "<h2 class=\"h2__username\">" . $_SESSION['username'] . "</h2>"	; 
			} 
			else {

				return "Couldn't recieve username";
			}
		}

		public function get_financial_content()
		{
			$obj = $this->financialWork_obj;
			$string = "";
			$string .= "There are " . $obj->get_cash() . " roubles on your account. <br/>";
			$string .= "There are " . $obj->get_cash_BankAccount() . " roubles on your bank account. <br/>";
			$string .= "There are " . $obj->get_cash_BrokerAccount() . " roubles on your broker account. <br/>";
			$string .= "There are " . $obj->get_cash_FirstDream() . " roubles for your first dream. <br/>";
			$string .= "There are " . $obj->get_cash_SecondDream() . " roubles for your second dream. <br/>";
			$string .= "There are " . $obj->get_cash_SafetyBag() . " roubles for your safety bag. <br/>";
			$string .= "You need to put on the brokerage account " . $obj->get_put_BrokerAccount() . " roubles. <br/>";
			$string .= "You need to put on the deposit " . $obj->get_put_BankAccount() . " roubles. <br/>";
			$string .= "And this money can be safely spent: " . $obj->get_cash_free() . " roubles. <br/>";
			$string .= "The first dream is " . $obj->get_percent_FirstDream() . " percent of the bank account<br/>";
			$string .= "The second dream is " . $obj->get_percent_SecondDream() . " percent of the bank account<br/>";
			$string .= "The safety bag is " . $obj->get_percent_SafetyBag() . " percent of the bank account<br/>";
			return $string;
		}
	}
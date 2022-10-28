<?php  
	class Categories extends Page
	{
		public function __construct(PDO $pdo_obj)
		{
			$this->pdo_obj = $pdo_obj;
		}

		public function get_categories($type)
		{
			$query = "SELECT name FROM categories WHERE type=\"$type\"";
			$raw = $this->pdo_obj->query($query);
			$result = $raw->fetchall();
			if (is_array($result))
			{
				return $result;
			}
			else
			{
				return 0;
			}
		}

		public function add_category($name, $type)
		{
			$query = "INSERT INTO categories(name, type) VALUES('$name', '$type')";
			$return = $this->pdo_obj->exec($query);
			if($return === 1)
				return 1;
			else
				return 0;
		}
	}
?>
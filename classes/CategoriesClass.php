<?php  
	class Categories extends Page
	{
		public function __construct(PDO $pdo_obj)
		{
			$this->pdo_obj = $pdo_obj;
		}

		public function get_categories($type)
		{
			$query = "SELECT name FROM categories WHERE type=\"$type\" AND author_id = " . $_SESSION['author_id'];
			$raw = $this->pdo_obj->query($query);
			$result = $raw->fetchall();
			return $result;
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
			$query = "INSERT INTO categories(name, type, author_id) VALUES('$name', '$type', '" . $_SESSION['author_id'] . "')";
			$return = $this->pdo_obj->exec($query);
			if($return === 1)
				return 1;
			else
				return 0;
		}
	}
?>
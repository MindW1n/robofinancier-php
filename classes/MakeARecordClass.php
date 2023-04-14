<?php 
	class MakeARecord extends Page
	{
		private $date;
		private $record;
		private $type;
		private $sum;
		private $category;
		private $author_id;
		private $pdo_obj;

		public function __construct($sum, $record, $category, $type, $date, $author_id, PDO $pdo_obj)
		{
			$this->sum = $sum;
			$this->record = $record;
			$this->category = $category;
			$this->type = $type;
			$this->date = $date;
			$this->author_id = $author_id;
			$this->pdo_obj = $pdo_obj;
		}

		public function make_a_record()
		{
			$query = "INSERT INTO records(sum, record, category, type, date, author_id) VALUES($this->sum, '$this->record', '$this->category', '$this->type', '$this->date', $this->author_id)";
			$return = $this->pdo_obj->exec($query);
			if($return === 1) {
			
				shell_exec("cd /opt/lampp/bin/ && ./mysqldump -u root robofinancierdatebase > /opt/lampp/htdocs/dataBasesDumps/backup.sql");
				return 1;
			}
			else
				return 0;
		}		
	}
?>

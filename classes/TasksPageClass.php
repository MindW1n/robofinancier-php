<?php  
	class TasksPage extends Page
	{	
		private $author_id;
		private $pdo_obj;

		public function __construct($author_id = none, PDO $pdo_obj)
		{
			$this->author_id = $author_id;
			$this->pdo_obj = $pdo_obj;
		}

		public function get_tasks()
		{
			$array = array();
			$query = "SELECT id, text FROM tasks WHERE author_id = $this->author_id";
			$raw = $this->pdo_obj->query($query);
			echo $rw;
			$result = $raw->fetchall();
			$index = 0;
			foreach ($result as $value_fst) {
				$array[] = array();
				foreach ($value_fst as $key_scnd => $value_scnd) {
					if ($key_scnd === "id" or $key_scnd === "text") 
					{
						$array[$index][] = $value_scnd;
					}
				}
				$index++;
			}
			return $array;
		}

		public function setTask($text)
		{
			$query = "INSERT INTO tasks(author_id, text) VALUES('$this->author_id', '$text')";
			$result = $this->pdo_obj->exec($query);
			return $result;
		}
		
		public function rmTask(array $tasks_id)
		{
			foreach ($tasks_id as $key => $value) {
				$query = "DELETE FROM tasks WHERE id=$key";
				$raw = $this->pdo_obj->exec($query);	
			}
		}
	}
<?php  
	class StatisticsPage extends Page
	{
		private $pdo_obj;
		private $year;
		private $id;
		private $statistics;

		public function __construct(PDO $pdo_obj, $year = False, $id)
		{
			$this->pdo_obj = $pdo_obj;
			$this->year = $year;
			$this->id = $id;
			$this->statistics = $this->get_statistics();
		}

		public function get_statistics()
		{
			if(!$this->year)
			{
				$query = "SELECT sum, type, category FROM records WHERE author_id = '$this->id'";
			}
			else
			{
				$query = "SELECT sum, type, category FROM records WHERE author_id = '$this->id' and date >= '$this->year-01-01' and date <= '$this->year-12-31'";
			}
			$raw = $this->pdo_obj->query($query);
			$result_array = $raw->fetchall();
			$incomes_array = $costs_array = array();
			$total = array();
			foreach ($result_array as $value) 
			{
				$array_type = str_replace("C", "c", (str_replace("I", "i", $value[1]))) . "s_array";
				eval("\$$array_type" . '[' . "\"$value[2]\"" . '][]' . " = $value[0];");
			} 
			$incomes_sum = 0;
			$costs_sum = 0;
			foreach ($incomes_array as $value) {
				foreach ($value as $sum) {
					$incomes_sum += $sum;
				}
			}
			foreach ($costs_array as $value) {
				foreach ($value as $sum) {
					$costs_sum += $sum;
				}
			}
			$incomes_percentages = $costs_percentages = array();
			foreach ($incomes_array as $key => $array)
			{
				$current_sum = 0;
				foreach ($array as $value)
				{
					$current_sum += $value;
				}
				$percentage = round($current_sum / $incomes_sum * 100, 1000);
				$incomes_percentages[$key] = [$current_sum, $percentage];
			}
			foreach ($costs_array as $key => $array)
			{
				$current_sum = 0;
				foreach ($array as $value)
				{
					$current_sum += $value;
				}
				$percentage = round($current_sum / $costs_sum * 100, 1000);
				$costs_percentages[$key] = [$current_sum, $percentage];
			}
			$total = ["incomes"     => $incomes_percentages,
					  "costs"       => $costs_percentages,
					  "incomes_sum" => $incomes_sum,
					  "costs_sum"   => $costs_sum];
			return $total;
		}

		public function draw_diagram()
		{
			$Img = ImageCreate(1920, 3000);
			$font = "D:/Tools/Openserver/domains/RoboFinancier/arial.ttf";
			$White = ImageColorAllocate($Img, 255, 255, 255);
			$Black = ImageColorAllocate($Img, 0, 0, 0);
			ImageFilledRectangle($Img, 0, 0, ImageSX($Img), ImageSY($Img), $White);
			$colors_indexes = ["red",
							   "green",
							   "blue",
							   "light blue",
							   "orange",
							   "purple",
							   "light green",
							   "pink",
							   "dark blue",
							   "light yellow",
							   "dark green",
							   "turquoise",
							   "dark orange",
							   "maroon",
							   "beige",
							   "grey",
							   "gold",
							   "silver",
							   "lava black",
							   "scarlet"
							  ];

			$colors = ["red" => ImageColorAllocate($Img, 237, 28, 36), 
					   "green" => ImageColorAllocate($Img, 0, 255, 0),
					   "blue" => ImageColorAllocate($Img, 0, 0, 255),
					   "light blue" => ImageColorAllocate($Img, 37, 191, 238), 
					   "orange" => ImageColorAllocate($Img, 242, 89, 0),
					   "purple" => ImageColorAllocate($Img, 160, 43, 155),
					   "light green" => ImageColorAllocate($Img, 89, 162, 39),
					   "pink" => ImageColorAllocate($Img, 255, 104, 168),
					   "dark blue" => ImageColorAllocate($Img, 26, 67, 136),
					   "light yellow" => ImageColorAllocate($Img, 253, 212, 3),
					   "dark green" => ImageColorAllocate($Img, 1, 80, 5),
					   "turquoise" => ImageColorAllocate($Img, 1, 182, 160),
					   "dark orange" => ImageColorAllocate($Img, 253, 92, 46),
					   "maroon" => ImageColorAllocate($Img, 122, 0, 23),
					   "beige" => ImageColorAllocate($Img, 234, 193, 144),
					   "grey" => ImageColorAllocate($Img, 120, 120, 120),
					   "gold" => ImageColorAllocate($Img, 186, 157, 85),
					   "silver" => ImageColorAllocate($Img, 158, 165, 184),
					   "lava black" => ImageColorAllocate($Img, 69, 46, 48),
					   "scarlet" => ImageColorAllocate($Img, 242, 61, 78)
					];
			$dark_colors = ["red" => ImageColorAllocate($Img, 177, 0, 0), 
					   "green" => ImageColorAllocate($Img, 0, 195, 0),
					   "blue" => ImageColorAllocate($Img, 0, 0, 195),
					   "light blue" => ImageColorAllocate($Img, 0, 131, 178), 
					   "orange" => ImageColorAllocate($Img, 182, 29, 0),
					   "purple" => ImageColorAllocate($Img, 100, 0, 95),
					   "light green" => ImageColorAllocate($Img, 29, 102, 0),
					   "pink" => ImageColorAllocate($Img, 195, 44, 108),
					   "dark blue" => ImageColorAllocate($Img, 0, 7, 76),
					   "light yellow" => ImageColorAllocate($Img, 193, 152, 0),
					   "dark green" => ImageColorAllocate($Img, 0, 20, 0),
					   "turquoise" => ImageColorAllocate($Img, 0, 122, 100),
					   "dark orange" => ImageColorAllocate($Img, 193, 32, 0),
					   "maroon" => ImageColorAllocate($Img, 62, 0, 0),
					   "beige" => ImageColorAllocate($Img, 174, 133, 84),
					   "grey" => ImageColorAllocate($Img, 60, 60, 60),
					   "gold" => ImageColorAllocate($Img, 126, 97, 25),
					   "silver" => ImageColorAllocate($Img, 98, 105, 124),
					   "lava black" => ImageColorAllocate($Img, 9, 0, 0),
					   "scarlet" => ImageColorAllocate($Img, 182, 1, 18)
					];
			$position = [747, 484];
			// make the 3d effect
			for($i = 650; $i > 600; $i--)
			{
				$start_angle = 0;
				$count = 0;
				foreach ($statistics["incomes"] as $key => $value) {
						$end_angle = $start_angle + round($value[1], 2) / 100 * 360;
						if ($end_angle  - $start_angle < 1)
						{
							continue;
						}
						imagefilledarc($Img, 400, $i, 470, 300, $start_angle, $end_angle, $dark_colors[$colors_indexes[$count]], IMG_ARC_PIE);
						$start_angle = $end_angle;
						$count += 1;
				}
			}
			$start_angle = 0;
			$count = 0;
			foreach ($statistics["incomes"] as $key => $value) {
					$end_angle = $start_angle + round($value[1], 2) / 100 * 360;
					if ($end_angle  - $start_angle < 1)
					{
						imagefilledrectangle($Img, $position[0], $position[1], $position[0] + 100, $position[1] + 50, $colors[$colors_indexes[$count]]);
						imagettftext($Img, 20, 0, $position[0] + 150, $position[1] + 25, $Black, $font, "- " . $key . ": " . $value[0] . " - " . round($value[1], 3) . "%");
						$position[1] += 150;
						$count += 1;
					}
					else
					{
						imagefilledarc($Img, 400, 600, 470, 300, $start_angle, $end_angle, $colors[$colors_indexes[$count]], IMG_ARC_PIE);
						imagefilledrectangle($Img, $position[0], $position[1], $position[0] + 100, $position[1] + 50, $colors[$colors_indexes[$count]]);
						imagettftext($Img, 20, 0, $position[0] + 150, $position[1] + 25, $Black, $font, "- " . $key . ": " . $value[0] . " - " . round($value[1], 3) . "%");
						$position[1] += 150;
						$start_angle = $end_angle;
						$count += 1;
					}
			}

			$position_two = [$position[0], $position[1] + 200];
			// make the 3d effect
			for($i = $position[1] + 350; $i > $position[1] + 300; $i--)
			{
				$start_angle = 0;
				$count = 0;
				foreach ($statistics["costs"] as $key => $value) {
						$end_angle = $start_angle + round($value[1], 2) / 100 * 360;
						if ($end_angle  - $start_angle < 1)
						{
							continue;
						}
						imagefilledarc($Img, 400, $i, 470, 300, $start_angle, $end_angle, $dark_colors[$colors_indexes[$count]], IMG_ARC_PIE);
						$start_angle = $end_angle;
						$count += 1;
				}
			}
			$start_angle = 0;
			$count = 0;
			foreach ($statistics["costs"] as $key => $value) {
					$end_angle = $start_angle + round($value[1], 2) / 100 * 360;
					if ($end_angle  - $start_angle < 1)
					{
						imagefilledrectangle($Img, $position_two[0], $position_two[1], $position_two[0] + 100, $position_two[1] + 50, $colors[$colors_indexes[$count]]);
						imagettftext($Img, 20, 0, $position_two[0] + 150, $position_two[1] + 25, $Black, $font, "- " . $key . ": " . $value[0] . " - " . round($value[1], 3) . "%");
						$position_two[1] += 150;
						$count += 1;
					}
					else
					{
						imagefilledarc($Img, 400, $position[1] + 300, 470, 300, $start_angle, $end_angle, $colors[$colors_indexes[$count]], IMG_ARC_PIE);
						imagefilledrectangle($Img, $position_two[0], $position_two[1], $position_two[0] + 100, $position_two[1] + 50, $colors[$colors_indexes[$count]]);
						imagettftext($Img, 20, 0, $position_two[0] + 150, $position_two[1] + 25, $Black, $font, "- " . $key . ": " . $value[0] . " - " . round($value[1], 3) . "%");
						$position_two[1] += 150;
						$start_angle = $end_angle;
						$count += 1;
					}
			}

			imagettftext($Img, 30, 0, 747, 348, $Black, $font, "Incomes: " . $statistics["incomes_sum"]);
			imagettftext($Img, 30, 0, 747, $position[1] + 100, $Black, $font, "Costs: " . $statistics["costs_sum"]);
			imagettftext($Img, 30, 0, 750, 150, $Black, $font, "Statistics for " . ($year ? $year : "all time") . "");
			imagerectangle($Img, 700, 200, 1170, 80, $Black);
			imagepng($Img, "image.png");
		}
	}
?>
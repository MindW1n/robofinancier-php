<?php  
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<title>Statistics</title>
</head>
<body>
	<?php if(isset($_SESSION['username']))?> <h2 class="h2__username"><?php echo $_SESSION['username'];?></h2>
	<?php 
		spl_autoload_register( function($classname){ require_once "../../classes/$classname" . "Class.php";});
		require_once "../../connect.php";
		if(!(isset($_REQUEST['year']) or isset($_REQUEST['flag'])) or $_REQUEST["year"] == "" and !isset($_REQUEST["flag"]))
		{
	?>
	<div class="title_Bill">
		<div class="content_Bill">
			<h2>Statistics</h2>
		</div>
	</div><br><br>
	<form method="POST">
		<h4>Enter the statistics year:</h4><br>
		<input type="input" name="year" placeholder="Year"><br><br>
		<input type="checkbox" name="flag" id="flag">
		<label for="flag">Do you want to see statistics for all time?</label><br>
		<a href="viewRecords.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a>
		<button class="btn-lg btn-primary btn-block btn" id="btn__register">Show statistics</button>
	</form>
	<?php 
		}
		else
		{
			if(isset($_REQUEST['year']))
			{
				$year = $_REQUEST['year'];
				$statistics_obj = new Statistics($pdo_obj, $_SESSION['author_id'], $year);
				$statistics = $statistics_obj->get_statistics();
				$Img = ImageCreate(1920, 3000);
				$font = "../etc/arial.ttf";
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
							imagefilledarc($Img, 400, $i, 470, 300, round($start_angle), round($end_angle), $dark_colors[$colors_indexes[$count]], IMG_ARC_PIE);
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
							imagefilledarc($Img, 400, 600, 470, 300, round($start_angle), round($end_angle), $colors[$colors_indexes[$count]], IMG_ARC_PIE);
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
							imagefilledarc($Img, 400, $i, 470, 300, round($start_angle), round($end_angle), $dark_colors[$colors_indexes[$count]], IMG_ARC_PIE);
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
							imagefilledarc($Img, 400, $position[1] + 300, 470, 300, round($start_angle), round($end_angle), $colors[$colors_indexes[$count]], IMG_ARC_PIE);
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
				imagepng($Img, "../etc/image.png");
			}
			$year = isset($_REQUEST['flag']) ? False : $year;	
			?>
				<a href="statistics.php" class="btn-lg btn-primary btn-block btn" id="btn__register">Back</a><br>
				<img src="../etc/image.png" alt=""><br>
			<?php
		} 
	?>
</body>
</html>
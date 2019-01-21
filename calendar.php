<?php
	function greetings()
	{
		echo "Good ";
		$time = date("H");
		$date = date("d/m/Y");
		
		if ($time >= 12) echo "Afternoon.";
		elseif ($time >= 18) echo "Evening.";
		else echo "Morning.";
		
		echo "<br>Today is $date.";
	}
	
	function line($week)
	{
		# get current day
		$day = date("d");
		
		$ac = 0;
		echo "<tr>";
		
		while ($ac < count($week))
		{
			echo "<th>";
			
			if ($ac == 0)
				echo "<font color='red'>$week[$ac]</font>";
			elseif ($ac == 6)
				echo "<font color='blue'>$week[$ac]</font>";
			else
				echo "$week[$ac]";
			
			echo "</th>";
			$ac++;
		}
		if ($ac != 0)
		{
			while ($ac < 7)
			{
				echo "<th></th>";
				$ac++;
			}
		}
		echo "</tr>";
	}
	
	function calendar()
	{
		$day = 1;
		$week = array();
		
		while ($day <= 31)
		{
			array_push($week, $day);
			
			if (count($week) == 7)
			{
				line($week);
				$week = array();
			}
			$day++;
		}
		line($week);
	}
	
	function names_of_day($full)
	{
		
		if ($full == true)
			$days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		else
			$days = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
		
		$ac = 0;
		
		while ($ac < count($days))
		{
			#echo "" . $days[$ac] . " ";
			echo "
				<th>$days[$ac]</th>
			";
			$ac++;
		}
	}
?>

<h1><?php echo "My Awesome Calendar"; ?></h1>
<h3><?php greetings(); ?></h3>

<table border="1">
	<tr>
		<?php names_of_day(true); ?>
	</tr>
	<?php calendar(); ?>
</table>
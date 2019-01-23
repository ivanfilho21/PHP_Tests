<?php
	date_default_timezone_set ("America/Bahia");
	
	function greetings()
	{
		echo "Good ";
		$time = date("H");
		$date = date("d/m/Y");
		
		if ($time <= 12) echo "Morning";
		elseif ($time <= 18) echo "Afternoon";
		else echo "Evening";
		
		echo ".<br>Today is $date.<br>";
	}
	
	function line($week, $current_month)
	{
		# get current day
		$day = date("d");
		$month = date("m");
		$total = 7;
		
		echo "<tr>";
		for ($i = 0; $i < $total; $i++)
		{
			if (isset($week[$i]) && $week[$i] > 0)
			{
				echo "<td align='center'>";
				if ($week[$i] == $day && $month == $current_month)
					echo "<b>";
				
				if ($i == 0) // Sundays
					echo "<font color='red'>{$week[$i]}</font>";
				elseif ($i == $total -1) // Saturdays
					echo "<font color='blue'>{$week[$i]}</font>";
				else
					echo "{$week[$i]}";
				
				if ($week[$i] == $day)
					echo "</b>";
				echo "</td>"; 
			}
			else
			{
				echo "<td></td>";
			}
		}
	}
	
	function calendar($starting_day, $num_of_days, $month_number)
	{
		$week = array();
		
		for ($day = $starting_day; $day <= $num_of_days; $day++)
		{
			array_push($week, $day);
			
			if (count($week) == 7)
			{
				line($week, $month_number);
				$week = array();
			}
		}
		
		$remaining_days = count($week);
		if ($remaining_days > 0)
			line($week, $month_number);
		
		return $remaining_days;
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

<h1><?php echo "My Awesome 2019 Calendar"; ?></h1>
<h3><?php greetings(); ?></h3>

<?php

	$months = array(array("January", 31), array("February", 28), array("March", 31), array("April", 30), array("May", 31),
					array("June", 30), array("July", 31), array("August", 31), array("September", 30), array("October", 31),
					array("November", 30), array("December", 31));
	$starting_day = 2;
	
	for ($i = 0; $i < count($months); $i++)
	{
		echo "<h3>{$months[$i][0]}</h3><br>";
		echo "<table border='1'>";
		names_of_day(true);
		$starting_day = calendar(1 - $starting_day, $months[$i][1], ($i + 1));
		#echo "<br> {$starting_day}";
		
		echo "</table>";
	}
?>

<!--
<table border="1">
	<tr>
		<?php names_of_day(true); ?>
	</tr>
	<?php
	for ($i = 0; $i < 12; $i++)
	{
		calendar("Jan");
	}
	?>
</table>-->
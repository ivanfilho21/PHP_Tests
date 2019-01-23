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
		
		echo ".<br>Today is $date.<br><h3>January</h3>";
	}
	
	function line($week)
	{
		# get current day
		$day = date("d");
		$total = 7;
		$boldS = "<b>";
		$boldE = "</b>";
		
		echo "<tr>";
		for ($i = 0; $i < $total; $i++)
		{
			if (isset($week[$i]) && $week[$i] > 0)
			{
				echo "<td align='center'>";
				if ($week[$i] == $day)
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
				echo "<td></td>";
		}
		/*
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
		*/
	}
	
	function calendar()
	{
		$week = array();
		
		for ($day = -1; $day <= 31; $day++)
		{
			array_push($week, $day);
			
			if (count($week) == 7)
			{
				line($week);
				$week = array();
			}
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
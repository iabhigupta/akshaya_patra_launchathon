<html>
<head>
	<title>Akshaya Patra</title>
</head>
<body>
<?php

	$dbname = "apdb";
	$user = "root";
	$pass = "";
	$host = "localhost";

	$con = mysql_connect($host, $user, $pass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());

	echo '<p><b><u>Data for kitchen</u></b></p>';
	echo "\n";
	echo "\n";
	$month = 3;
	$year = 2014;
	//add logic for analysing data
		
	function est($day)
	{
		//for a specific day
		echo "<p>";
		echo 'day = ';
		echo $day;
		echo "\r\n";
		$day_mod = $day % 7;
		echo '| day_mod = ';
		echo $day_mod;
		echo "\r\n";
		if($day_mod==0) 
			$day_mod=1;
		$query = "SELECT att FROM bm2 WHERE date = $day_mod";
		$result = mysql_query($query) or die(mysql_error());
		$old_data1 = mysql_fetch_assoc($result);
		$old_data1 = $old_data1['att'];
		echo "\n";
		echo "\n";
		echo '| previous_record_1 = ';
		echo $old_data1;
		//echo "\$" . $old_data1; 
		echo "\n";
		
		$query = "SELECT att FROM bm2 WHERE date = ($day_mod +7)";
		$result = mysql_query($query);
		$old_data2 = mysql_fetch_assoc($result);
		$old_data2 = $old_data2['att'];
		echo '| previous_record_2 = ';
		echo $old_data2;
		echo "\r\n";
		
		$query = "SELECT att FROM bm2 WHERE date = ($day_mod + 14)";
		$result = mysql_query($query);
		$old_data3 = mysql_fetch_assoc($result);
		$old_data3 = $old_data3['att'];
		echo '| previous_record_3 ';
		echo $old_data3;
		echo "\r\n";
		
		$query = "SELECT att FROM bm2 WHERE date = ($day_mod + 21)";
		$result = mysql_query($query);
		$old_data4 = mysql_fetch_assoc($result);
		$old_data4 = $old_data4['att'];
		echo '| previous_record_4 ';
		echo $old_data4;
		echo "\r\n";
		$sum =(int)($old_data1 + $old_data2 + $old_data3 + $old_data4);
		echo " | sum = ";
		echo $sum;
		$est_stage1 = $sum/4;
		echo ' | stage_1_estimation = ';
		echo $est_stage1;
		echo "\r\n";
		$query = "SELECT te FROM superv2 WHERE date = $day";
		$result = mysql_query($query);
		$new_data = mysql_fetch_assoc($result);
		
		$est_stage2 = ($est_stage1 + $new_data['te'])/2;
		echo ' | stage_2_estimation = ';
		echo $est_stage2;
		echo "\r\n";
		echo "</p>";
		return $est_stage2;
	}
	for ($day=1; $day<=31; $day++)
	{
		$calculated_estimate_day[$day] = est($day);
		echo '<p>Estimate made:';
		echo " | For March ";
		echo $day;
		echo " , 2014";
		echo " | Calculated Estimate: ";
		echo (floor($calculated_estimate_day[$day]));
		echo "\n";
		echo "\n";
		echo "\n";
		echo "</p>";
		echo "<hr/>";
	}

//close db connection
//mysqli_close($con);
?>
</body>
</html>
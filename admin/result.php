<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UTop Tutor Result</title>

<?php
	if($_POST["username"] != "zzz" || $_POST["password"] != "zzz"){
		header("Location: ../404.html");
		exit;
	}
	$startDate = $_POST["date1"];
	$endDate = $_POST["date2"];
	
	$dbc = mysqli_connect('localhost', 'root', '', 'utop');
	$query = "SELECT *, t.order_id AS oid 
			  FROM timetable t LEFT JOIN orders o ON t.order_id = o.order_id 
			  WHERE date >= ".$startDate." and date <= ".$endDate.
			 " ORDER BY time, date";
	$result = mysqli_query($dbc, $query);

	$form = '<table border=1><tr><th scope="col">Time</th>';
	$col = 0;
	do {
		$date = date("Ymd", strtotime($startDate." +".$col." day"));
		$day = date("l", strtotime($startDate." +".$col." day"));
		$form .= '<th scope="col">'.$date.'<br>'.$day.'</th>';
		$col++;
	} while($date < $endDate);
	$form .= '</tr>';
	for($i = 9; $i <= 21; $i++) {
		$form .= "<tr><td>".$i.":00</td>";
		for($j = 1; $j <= $col; $j++) {
			$row = mysqli_fetch_array($result);
			$value = $row["date"].$row["time"];
			$form .= "<td><input type='checkbox' name='$value' value='$value'/>
					<label for='$value'>";
			if($row["oid"])
				$form .= "N/A ";
			$form .= $row["username"];
			if($row["email"])
				$form .= "<br>".substr($row["email"], 0, strpos($row["email"], '@'));
			if($row["course"])
				$form .= "<br>".$row["course"];
			if($row["payment"])
				$form .= " ".$row["payment"];
			if($row["note"])
				$form .= "<br>".$row["note"];
			$form .= "</label></td>";
		}
		$form .= "</tr>";
	}
	$form .= "</table>";
	mysqli_close($dbc);
?>
</head>
    
<body>
<form name="form1" method="post" action="update.php">
	<input type="hidden" name="date1" class="date-pick" id="date1" 
		   value="<?php echo $startDate;?>" readonly="readonly" />
	<input type="hidden" name="date2" class="date-pick" id="date2" 
		   value="<?php echo $endDate;?>" readonly="readonly" />
	<?php echo $form;?><br>
    Change name to:           <input name="name" type="text">
    Change email to:          <input name="email" type="text"><br>
    Change course to:         <input name="course" type="text">
    Change payment to:        <input name="payment" type="text"><br>
    <input name="submit" type="submit" value="Submit">
</form>
</body>
</html>

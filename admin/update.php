<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UTop Tutor Update</title>
<?php
	$startDate = $_POST["date1"];
	$endDate = $_POST["date2"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$course = $_POST["course"];
	$payment = $_POST["payment"];
	
	$dbc = mysqli_connect('localhost', 'root', '', 'utop');
	$i = 1;
	foreach ($_POST as $value) {
		if ($value != "Submit" and $value != $name and $value != $email and
			$value!=$course and $value!=$payment and $value!=$startDate and
			$value!=$endDate) {
			$date = substr($value, 0, 4).substr($value, 5, 2).substr($value, 8, 2);
			$time = substr($value, 10);
			$query = "SELECT * FROM timetable WHERE date=$date and time=$time";
			$result = mysqli_query($dbc, $query);
			$row = mysqli_fetch_array($result);
			$oid = $row["order_id"];
			if($email == "" and $course == "" and $payment == "" and 
			   ($name == "" or $name == "Personal")) {
				$query = "UPDATE timetable SET order_id='$name' 
						  WHERE date=$date and time=$time";
				mysqli_query($dbc, $query);
				$query = "SELECT * FROM timetable WHERE order_id=$oid";
				$result = mysqli_query($dbc, $query);
				$row = mysqli_fetch_array($result);
				if($row["order_id"] == "") {
					$query = "DELETE FROM orders WHERE order_id=$oid";
					mysqli_query($dbc, $query);
				}
			} else {
				if(!$oid or $oid='Lecture') {
					$oid = date("YmdHis");
					$query = "UPDATE timetable SET order_id=$oid 
							  WHERE date=$date and time=$time";
					mysqli_query($dbc, $query);
					$query = "INSERT INTO orders(order_id, username, email, course, 
							payment, note) VALUES ($oid, '$name', '$email', 
							'$course', '$payment', '')";
					mysqli_query($dbc, $query);
				} else {
					$query = "UPDATE orders SET username='$name', 
					email='$email',	course='$course', payment='$payment', '' 
					WHERE order_id='$oid'";
					mysqli_query($dbc, $query);
				}
				
			}
			$i = $i + 1;
		}
	}
	mysqli_close($dbc);
?>
</head>

<body>
Success!
<form name="form" id="form" method="post" action="result.php">
	<input type="hidden" name="date1" class="date-pick" id="date1" value="<?php echo $startDate;?>" readonly="readonly" />
	<input type="hidden" name="date2" class="date-pick" id="date2" value="<?php echo $endDate;?>" readonly="readonly" /><br>
	<input name="submit" type="submit" value="Back">
	<input type="hidden" name="username" value="zzz" />
	<input type="hidden" name="password" value="zzz" />
</form>
</script>
</body>
</html>

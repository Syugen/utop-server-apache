<!DOCTYPE HTML>
<?php
        if (!isset($_COOKIE["utopName"])){
		header("Location: 404.html");
		exit;
	}
        setcookie("utopName", "", time() - 360000);
	setcookie("utopEmail", "", time() - 360000);
	setcookie("utopTime", "", time() - 360000);

	$name = $_COOKIE["utopName"];
	$email = $_COOKIE["utopEmail"];
	$curTime = $_COOKIE["utopTime"];
	$tx = $tx_shown = $_GET["tx"];
	if(isset($_POST["password"]))
		$tx .= ' '.$_POST["password"];

	$dbc = mysqli_connect('localhost', 'root', '', 'utop');
	$query = "UPDATE orders SET payment='$tx' 
			  WHERE order_id='$curTime';";
	mysqli_query($dbc, $query);
	mysqli_close($dbc);

	require("PHPMailer_5.2.0/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "smtp.126.com";
	$mail->Username = "timeless10814@126.com";
	$mail->Password = "zhouyuan94";
	$mail->Port = 25;
	$mail->From = "timeless10814@126.com";
	$mail->FromName = "UTop Tutor";
//	if($tx != "Cash") {
		$mail->AddAddress($email);
		$mail->AddBCC("utoptutoring@gmail.com");
//	} else
//		$mail->AddAddress("utoptutoring@gmail.com");
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = $name." - UTop Tutor Payment Notification";
/*	if($tx == 'Cash') {
		$mail->Body = "Thank you!<br><br>";
	} else if($tx_shown == 'EMT'){
		$mail->Body = "Thank you!<br><br>";
	} else {
		$mail->Body = "Thanks for your payment.<br><br>Your payment has been recorded!<br>";
	}
	$mail->Body = "<b>Name:</b> $name<br><b>Email:</b> 
				   $email<br><b>Payment:</b> $tx<br><br>
				   Thanks!<br>UTop Tutor";
*/	$mail->Body = $email_content;
	$mail->Send();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Utop Tutor Success</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<!--start-header-section-->
<div class="header-section">
	<div class="continer">
		<a href="index.php"><img src="images/p1.jpg"></a>
		<h1>UTop Tutor<span>!</span></h1>
		<p>University of Toronto St. George</p>
		<a href="#contact" class="scroll top">
		<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true">
		</span></a>
	</div>
</div>
<!--end header-section-->

<!--start-study-section-->
<div class="study-section">
	<div class="container">
		<div class="study-grid">
			<h3>Success..<span>!</span><p></h3>
			<h4>Your payment has been recorded! Thank you!<p></h4>
			<h4><b>Name:</b> <?php echo $name;?><p></h4>
			<h4><b>Email:</b> <?php echo $email;?><p></h4>
			<h4><b>Payment:</b> <?php echo $tx_shown;?><p></h4>
			<?php 
				if($tx_shown == 'EMT')
					echo '<h4>We will confirm your transaction ASAP.</h4>';
				if($tx != 'Cash')
					echo '<h4>An confirmation letter has been sent to your 
						  email address.</h4>';
			?>
		</div>
	</div>
</div>
<!--end study-section-->
				
<!--start-footer-section-->
<div class="footer-section">
	<div class="container">
		<p>&copy; 2016 UTop Tutor All rights reserved | Designed by W3layouts | 
		Modified by Syugen, Jing </p>
		<a href="#" id="toTop" style="display: block;">
		<span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
</div>
<!--end-footer-section-->

</body>
</html> 

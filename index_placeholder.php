<!DOCTYPE HTML>
<html>
<head>
<title>UTop Tutor</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript">
	addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<!---- start-smoth-scrolling---->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
		});
	});
</script>
<!---End-smoth-scrolling---->

<?php
	$dbc = mysqli_connect('localhost', 'root','', 'utop');
	$curDate = date("Ymd");
	$startDate = date("Ymd", strtotime($curDate." +1 day"));
	$endDate = date("Ymd", strtotime($curDate." +7 day"));
	$query = "SELECT * FROM timetable 
			  WHERE date >= ".$startDate." and date <= ".$endDate.
			 " ORDER BY time, date";
	$result = mysqli_query($dbc, $query);
?>
<script>
function validate(thisform)
{
	if(document.getElementById("submitting").innerHTML == "Submitting...") {
		document.getElementById("submitErr").innerHTML = "Please do not re-submit.";
		return false;
	}
	var flag = true
	var reg_email = /^(\w-*)+(\.\w+)*@(\w)+((\.\w+)+)$/;
	var reg_ut = /^\w+\.\w+@(mail.)?utoronto.ca$/;
	
	if(thisform.name.value == "WeChat Name") {
		document.getElementById("nameErr").
			innerHTML = "* You must enter a name";
		flag = false;
	} else document.getElementById("nameErr").innerHTML = "*";
	
	if(thisform.email.value == "Email") {
		document.getElementById("emailErr").
		innerHTML = "* You must enter an email";
		flag = false;
	} else if(!reg_email.test(thisform.email.value)) {
		document.getElementById("emailErr").innerHTML = "* Invalid email";
		flag = false;
	} else if(!reg_ut.test(thisform.email.value)) {
		document.getElementById("emailErr").
			innerHTML = "* Not a valid UofT email";
		flag = false;
	} else document.getElementById("emailErr").innerHTML = "*";
	
	if(thisform.course.selectedIndex == 0) {
		document.getElementById("courseErr").
			innerHTML = "* You must choose a course";
		flag = false;
	} else document.getElementById("courseErr").innerHTML = "*";
	
	if(thisform.policy.checked == false) {
		document.getElementById("policyErr").
			innerHTML = "* You must agree to the policy";
		flag = false;
	} else document.getElementById("policyErr").innerHTML = "";
	
	if(!flag)
		document.getElementById("submitErr").
			innerHTML = "Please check your information and try again.";
	else document.getElementById("submitting").innerHTML = "Submitting...";
	return flag;
}
</script>
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
		<div class="col-md-6 study-grid">
			<h3>Goal..<span>!</span></h3>
			<div class="study1">
				<p>We have out best tutors and affordable 
				<label>one-on-one</label> computer science and math tutoring 
				services for students who want academic success on their first 
				and second year courses. </p>
				<p>You name your problems, we help you overcome them.</p>
				<p>专业课爆分/A+的高年级大腿们为您提供系统性引导式讲解，帮您
				解决疑惑，让您考试/赶due都不慌！</p>
			</div>
		</div>
		<div class="col-md-6 study-grid">
			<h3>Most popular..<span>!</span></h3>
			<div class="study2">
				<h4>CSC108<h4>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" 
						 style="width: 90%" ></div>
				</div>
				<h4>CSC165</h4>
				<div class="progress">
					<div class="progress-bar progress-bar-warning"
						 style="width: 70%" ></div>
				</div>
				<h4>MAT135/136/137/223/224</h4>
				<div class="progress">
					<div class="progress-bar progress-bar-info"
						 style="width: 50%" ></div>	
				</div>
			</div>
		</div>
	</div>
</div>
<!--end study-section-->

<!--start-services-section-->
<div class="service-section" id="service">
	<div class="container">
		<div class="col-md-4 service-grid">
			<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			<h4>作业辅导</h4>
			<span> </span>
			<p>无论您是零基础还是半知半解，面对作业是毫无头绪还是稍有思路，我
			们手把手帮您！让您通过一对一辅导写出作业、学习如何debug、提高自己
			编程能力！</p>
		</div>
		<div class="col-md-4 service-grid">
			<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
			<h4>在线解答</h4>
			<span> </span>
			<p>辅导过的同学可以将一些小问题在线发送至公众号平台，我们会有专业
			人员在固定时间为您解答！</p>
		</div>
		<div class="col-md-4 service-grid">
			<span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
			<h4>考前复习</h4>
			<span> </span>
			<p>一对一的考前复习讲解，让您哪里有疑惑就问哪里，考前查缺补漏，省
			下大班讲课辅导听课整理笔记的时间，效率翻倍！</p>
		</div>
	</div>
</div>
<!--end services-section-->

<!--start-contact-section-->
<div class="contact-section" id="contact">
	<div class="container">
		<h3>Booking</h3>
		<div class="contact-details">本功能将于9月开启，敬请期待！
		</div>		 
	</div>
</div>
<!--end-contact-section-->
				
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

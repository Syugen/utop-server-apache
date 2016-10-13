﻿<!DOCTYPE HTML>
<html>
<head>
<title>UTop Tutor</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="images/favicon.ico" rel="shorcut icon" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
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
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}
function autofill() {
	alert("?");
	if (getCookie("utoptutorUser") != "") {
		document.getElementById("name").value = getCookie("utoptutorUser");
	}
	if (getCookie("utoptutorEmail") != "")
		document.getElementById("email").value = getCookie("utoptutorEmail");
	if (getCookie("utoptutorCourse") != "")
		document.getElementById("course").selectedIndex = getCookie("utoptutorCourse");
}
function validate(thisform)
{
	if(document.getElementById("submitting").innerHTML == "Submitting...") {
		document.getElementById("submitErr").innerHTML = "Please do not re-submit.";
		return false;
	}
	var flag = true
	var reg_email = /^(\w-*)+(\.\w+)*@(\w)+((\.\w+)+)$/;
	var reg_ut = /^\w+\.\w+@mail.utoronto.ca$/;
	
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
	else {
		document.getElementById("submitErr").innerHTML = "";
		document.getElementById("submitting").innerHTML = "Submitting...";
/*		if(thisform.remember.checked == true) {
			setCookie("utoptutorRememberUser", thisform.name.value, 365);
			setCookie("utoptutorRememberEmail", thisform.email.value, 365);
			setCookie("utoptutorRememberCourse", thisform.course.selectedIndex, 365);
		} else {
			setCookie("utoptutorRememberUser", thisform.name.value, 0);
			setCookie("utoptutorRememberEmail", thisform.email.value, 0);
			setCookie("utoptutorRememberCourse", thisform.course.selectedIndex, 0);
		}
*/	}
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
				<p>专业课爆分/A+的高年级大腿, 入学奖学金和年年评为优秀学生的学霸们为您提供系统性引导式讲解，帮您
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
				<h4>CSC165/CSC148</h4>
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
			<p>想学好一门课可听课总有些小细节遗漏, 认真写了作业可总有地方扣分,
			不想花太多钱去上大班辅导课, 可能就是需要一个有经验的人点拨一番,来和
			我们聊聊!</p>
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
		<div class="contact-details">
			<form action="submit.php" onSubmit="return validate(this);" method="post">
			<div class="contact-left">
				微信ID (非昵称，请勿输入中文字符): <span id="nameErr" class="error">*</span><br>
				<input type="text" class="text" name="name" id="name" value="WeChat Name" 
				onfocus="if (this.value == 'WeChat Name') {this.value = '';};" 
				onblur="if (this.value == '') {this.value = 'WeChat Name';}">
				U of T 邮箱: <span id="emailErr" class="error">*</span><br>
				<input type="text" class="text" name="email" id="email" value="Email" 
				onfocus="if (this.value == 'Email') {this.value = '';};" 
				onblur="if (this.value == '') {this.value = 'Email';}">
				课程: [点击<a href="course.html" target="_blank">这里</a>查看辅导课程内容详情]<br>
				<span id="courseErr" class="error">*</span><br>
				<select name="course" id="course" value="Course">
					<option value="0">PLEASE SELECT</option>
					<option value="CSC108">CSC108 (单人, $30/hr)</option>
					<option value="CSC108 (Group)">CSC108 (两人, $25/hr/人)</option>
					<option value="CSC148">CSC148 (单人, $35/hr)</option>
					<option value="CSC165">CSC165 (单人, $35/hr)</option>
				</select>
				地点:<br>
				Bahen Center (<a href="location/ba.html" target="_blank">BA</a>)[默认首选]<br>
				New College (<a href="location/nc.html" target="_blank">40/45 Willcocks St.</a>)<br>
				Robarts Library (<a href="location/rb.html" target="_blank">RB</a>)<br>
				<span id="policyErr" class="error"></span><br>
				<input type='checkbox' id='policy' value='Policy'/>
				I agree to the <a href="policy.html" target="_blank">Policy</a>.
				<span class="error">[10月1日更新]</span>
				<span class="error">*</span><br>
			</div>
			<div class="contact-right">
				注：勾选某一时间表示选择该小时。例如勾选“9:00”表示选择九点到十点。可多选。<br>
				<table border="1" style="table-layout: fixed; 
				word-break: break-all; word-wrap: break-word;">
					<?php

echo "<tr>";
for($i = 0; $i <= 6; $i++) {
	$date = date("m-d", strtotime($startDate." +".$i." day"));
	$day = substr(date("l", strtotime($startDate." +".$i." day")), 0, 3).".";
	echo "<th scope='col'>$date<br>$day</th>";
}
echo "</tr>";
for($i = 9; $i <= 21; $i++) {
	echo "<tr>";
	for($j = 1; $j <= 7; $j++) {
		echo "<td>";
		$row = mysqli_fetch_array($result);
		$value = $row["date"].$row["time"];
		if(!$row['order_id'])
			echo "<input type='checkbox' name='$value' value='$value'/>
				<label for='$value'>".$row["time"].":00</label></td>";
		else echo "N/A</td>";
	}
	echo "</tr>";
}
mysqli_close($dbc);

					?>
				</table>
			</div>
			<div class="contact-right-submit">
				<span id="submitErr" class="error"></span>
				<span id="submitting"></span>
				<input type="submit" name="submit" id="submit" value="Submit" />
			</div>
			</form>
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
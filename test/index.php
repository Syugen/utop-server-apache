<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UTop Tutor Test</title>
</head>

<body>
<?php
/*	if(isset($_COOKIE["csc108test"])) {
		echo "您已在过去的24小时（1日）内免费测试过，请等待或付费。<br>";
	} else {
		echo "请注意，每24小时（1日）内您只能免费测试一次，获得更多测试机会我们提供付费服务。<br>";
	}
*/	setcookie("csc108test_index", "csc108test_index", time()+86400);
?>
<!--点击<a href="pay" target="_blank">这里</a>查看具体付费信息。<br>-->
<h2>CSC108 Assignment 1免费测试</h2>
<script src="//www.powr.io/powr.js" external-type="html"></script> 
<div class="powr-countdown-timer" id="4dbdd9aa_1475299045042"></div>
请将代码完整复制到文字框中。<br>
<form name="form" id="form" method="post" action="result.php">
<?php
	if(isset($_COOKIE["csc108test"])) {
		echo "请输入付费号码：<input name='uid' type='text'><br>";
	} else {
		echo "<input name='uid' type='hidden'>";
	}
?>
	<textarea name="textarea" style="width:500px;height:500px;font-family:Courier New"></textarea><br>
	<input name="submit" type="submit" value="提交">
<br>课程辅导报名网址：<a href="../index.php">utoptutoring.ml</a>
</form>
</script>
</body>
</html>

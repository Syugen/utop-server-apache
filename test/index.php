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
<h3>CSC108 Assignment 2免费测试</h3>
<script src="//www.powr.io/powr.js" external-type="html"></script> 
<form name="form" id="form" method="post" action="result.php" enctype="multipart/form-data">
<?php
	if(isset($_COOKIE["csc108test"])) {
		echo "请输入付费号码：<input name='uid' type='text'><br>";
	} else {
		echo "<input name='uid' type='hidden'>";
	}
?>
<table>
<tr>
	<td>上传palindromes.py:</td>
	<td><input type="file" name="palindromes" id="palindromes"></td>
</tr>
<tr>
	<td>上传dna.py:</td>
	<td><input type="file" name="dna" id="dna"></td>
</table>
	文件名必须为"pylindromes.py"和"dna.py"，否则会编译失败。<br>
	说明：点击提交按钮，表明你已知晓你的代码将会加密传输给utoptutoring.ml服务器；<br>
	服务器在测试完你的代码后会立刻（在你看到结果之前）删除你传送的文件。<br>
	<input name="submit" type="submit" value="提交">
<br><br><br>课程辅导报名网址：<a href="../index.php">utoptutoring.ml</a>
</form>
</body>
</html>

<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UTop Tutor Release Cookie</title>
</head>

<body>
<?php
	if(isset($_COOKIE["csc108test"]))
		setcookie("csc108test", "csc108test", time()-86400);
		header("Location: index.php");
?>
</body>
</html>

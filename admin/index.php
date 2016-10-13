<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UTop Tutor Admin</title>
</head>
    
<body>
<form name="chooseDateForm" id="chooseDateForm" action="result.php" method="post">
	Start date:<input name="date1" class="date-pick" value=<?php echo date("Ymd");?> /><br>
	End date:  <input name="date2" class="date-pick" value=<?php echo date("Ymd", strtotime(date("Ymd")." +14 day"));?> /><br>
	Username:  <input name="username" type="inpt" /><br>
	Password:  <input name="password" type="password" />
	<input type="submit" name="submit" id="submit" value="Submit">
</form>
</body>
</html>

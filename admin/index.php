<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UTop Tutor Admin</title>
        <?php
            $date1 = date("Ymd");   
            $date2 = date("Ymd", strtotime(date("Ymd")." +14 day"));    
        ?>
    </head>
        
    <body>
        <form action="result.php" method="post">
            Start date:<input name="date1" value="<?php echo $date1; ?>"><br>
            End date:  <input name="date2" value="<?php echo $date2; ?>"><br>
            Username:  <input name="username" type="inpt"><br>
            Password:  <input name="password" type="password">
            <input type="submit" name="submit" id="submit" value="Submit">
        </form>
    </body>
</html>

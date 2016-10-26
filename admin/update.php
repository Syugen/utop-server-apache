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
    $log_file = fopen("log.txt", "a");
    $log = "<ol>";
    foreach ($_POST as $value) {
        if ($value != "Submit" and $value != $name and $value != $email and
            $value!=$course and $value!=$payment and $value!=$startDate and
            $value!=$endDate) {
            
            $log .= "<li>Change on time slot: $value</li><ul><li>Fetching data:</li>";
            fwrite($log_file, "[".date("Y-m-d H:i:s")."] Change on time slot: $value.\n");
            fwrite($log_file, "[".date("Y-m-d H:i:s")."] Fetching data:\n");

            $date = substr($value, 0, 10);
            $time = substr($value, 11);
            $query = "SELECT * FROM timetable WHERE date='$date' and time='$time'";
            $result = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);
            $oid = $row["order_id"];
            $log .= $query;
            fwrite($log_file, "[".date("Y-m-d H:i:s")."] $query\n");

            if(!$email and !$course and !$payment and (!$name or $name == "Personal")) {
                $string = $name ? "personal use:" : "empty:";
                $log .= "<li>Slot set to $string</li>";
                fwrite($log_file, "[".date("Y-m-d H:i:s")."] Slot set to $string\n");

                // 删除本项，或标记为个人占用
                // timetable中清空/标记order_id
                $query = "UPDATE timetable SET order_id=".
                         ($name ? "'$name'" : "NULL").
                         " WHERE date='$date' and time='$time'";
                mysqli_query($dbc, $query);
                $log .= $query;
                fwrite($log_file, "[".date("Y-m-d H:i:s")."] $query\n");

                // 如果原来本项存在订单号，在orders中删除该订单
                if($oid) {
                    $query = "DELETE FROM orders WHERE order_id=$oid";
                    mysqli_query($dbc, $query);
                    $log .= "<br>".$query;
                    fwrite($log_file, "[".date("Y-m-d H:i:s")."] $query\n");
                }

            } else if(!$oid or $oid == "Personal") {
                $log .= "<li>Slot set to new order:</li>";
                fwrite($log_file, "[".date("Y-m-d H:i:s")."] Slot set to new order:\n");

                // 手动预定
                $oid = date("YmdHis");
                $query = "UPDATE timetable SET order_id=$oid ".
                         "WHERE date='$date' and time='$time'";
                mysqli_query($dbc, $query);
                $log .= $query;
                fwrite($log_file, "[".date("Y-m-d H:i:s")."] $query\n");

                $query = "INSERT INTO orders(order_id, username, email, ".
                         "course, payment, note) VALUES ($oid, '$name', ".
                         "'$email', '$course', '$payment', '')";
                mysqli_query($dbc, $query);
                $log .= "<br>".$query;
                fwrite($log_file, "[".date("Y-m-d H:i:s")."] $query\n");
            } else {
                $log .= "<li>update order:</li>";
                //更新信息
                $query = "UPDATE orders SET ".
                         ($name == "" ? "" : "username='$name', ").
                         ($email == "" ? "" : "email='$email', ").
                         ($course == "" ? "" : "course='$course', ").
                         ($payment == "" ? "" : "payment='$payment', ").
                         "note='' WHERE order_id='$oid'";
                mysqli_query($dbc, $query);
                $log .= $query;
                fwrite($log_file, "[".date("Y-m-d H:i:s")."] $query\n");
            }
            $log .= "</ul>";
        }
    }
    $log .= "</ol>";
    fclose($log_file);
    mysqli_close($dbc);
?>
</head>

<body>
Success!<br>
<?php echo $log; ?>
<form name="form" id="form" method="post" action="result.php">
    <input type="hidden" name="date1" value="<?php echo $startDate;?>">
    <input type="hidden" name="date2" value="<?php echo $endDate;?>"><br>
    <input name="submit" type="submit" value="Back">
    <input type="hidden" name="username" value="zzz" />
    <input type="hidden" name="password" value="zzz" />
</form>
</script>
</body>
</html>

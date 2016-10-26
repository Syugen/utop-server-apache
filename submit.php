<!DOCTYPE HTML>
<?php
    if(!isset($_POST["name"])) {
        header("Location: 404.html");
        exit;
    }

    setcookie("utopName", $_POST["name"], time() + 360000);
    setcookie("utopEmail", $_POST["email"], time() + 360000);
    setcookie("utopTime", date("YmdHis"), time() + 360000);

    // 表单中最常用的三项
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];

    // 如果选择记住微信、邮箱和课程，设置cookie
    if(isset($_POST["remember"])) {
        setrawcookie("utopRememberName", $name, time() + 360000);
        setrawcookie("utopRememberEmail", $email, time() + 360000);
        setrawcookie("utopRememberCourse", $course, time() + 360000);
    } else {
        setrawcookie("utopRememberName", "", time() - 360000);
        setrawcookie("utopRememberEmail", "", time() - 360000);
        setrawcookie("utopRememberCourse", "", time() - 360000);
    }

    // 邮件预设置
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
    $mail->AddAddress("utoptutoring@gmail.com");
    $mail->AddAddress($email);
    $mail->WordWrap = 0;
    $mail->IsHTML(true);
    $mail->Subject = $name." - UTop Tutor Order Confirmation";
    $mail->Body = "Name: $name<br>Course: $course<br>You ordered:<br>";

    // Paypal按钮预设置
    $button_a = '<form action="https://www.paypal.com/cgi-bin/webscr"
                method="post" target="_self">
                <input type="hidden" name="cmd" value="_xclick" />
                <input type="hidden" name="business" value="utoptutoring@gmail.com"/>
                <input type="hidden" name="item_name" value="UTop Tutor"/>
                <input type="hidden" name="item_number" value="001"/>
                <input type="hidden" name="amount" value="';
    $button_b = '"/>
                <input type="hidden" name="currency_code" value="CAD"/>
                <input type="hidden" name="lc" value="CA"/>
                <input type="hidden" name="bn" value="btn_paynowCC_LG.gif"/>
                <input type="hidden" name="quantity" value="';
    $button_c = '"/>
                <input type="image"
                src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif"
                name="submit" alt="Make payments with PayPal"/></form>';
    
    // Paypal链接费用预设置
    $unit = 0;
    if($course == "CSC108") $unit = 30;
    else if($course == "CSC148" or $course == "CSC165") $unit = 35;
    else if($course == "CSC108 (Group)") $unit = 50;
    
    // 连接服务器
    $dbc = mysqli_connect('localhost', 'root', '', 'utop');

    $i = 0;
    foreach ($_POST as $value) {
        if ($value!="submit" and $value != "remember" and
            $value!=$name and $value!=$email and $value!=$course) {
            $date = substr($value, 0, 4).substr($value, 5, 2).substr($value, 8, 2);
            $dateDash = substr($value, 0, 10);
            $time = substr($value, 10);
            $curTimeTight = date("YmdHis");

            $query = "SELECT * FROM timetable WHERE date = $date and time = $time";
            $row = mysqli_fetch_array(mysqli_query($dbc, $query));
            if($row['order_id']) {
                echo "<span class='error'>Sorry, but $dateDash $time:00 has been 
                      ordered.</span><br>";
                $mail->Body .= "Failed to order: $dateDash $time:00<br>";
            } else {
                $query = "UPDATE timetable SET order_id='$curTimeTight' 
                      WHERE date=$date and time=$time";
                mysqli_query($dbc, $query);

                $query = "INSERT INTO orders VALUES ('$curTimeTight', '$name', 
                      '$email', '$course', '', '')";
                mysqli_query($dbc, $query);
                $i++;
                $mail->Body .= "$i. $dateDash $time:00<br>";
            }
        }
    }
    mysqli_close($dbc);
    $mail->Body .= "<br>Thanks!<br>UTop Tutor";
    $mail->Send();
?>

<html>
    <head>
        <title>UTop Tutor Submit</title>
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
            </div>
        </div>
        <!--end header-section-->
    
        <!--start-study-section-->
        <div class="study-section">
            <div class="container">
                <div class="col-md-6 study-grid">
                    <h3>Submitted<span>!</span></h3>
                    <div class="study1">
                        您的预定信息如下：<br><br>
                        <?php echo $mail->Body ?><br><br>
                        如果预订信息中出现"Failed to order"表明预定失败（可能是其他同学
                        刚刚报名了这个时间，或者你重复提交了报名），请立刻联系客服（微信：
                        UTopTutor）。辅导地点具体位置将在辅导前一小时内通知。如需更改地点，
                        有任何其他问题，也请联系客服。
                    </div>
                </div>
                <div class="col-md-6 study-grid">
                    <h3>One Last Step<span>!</span></h3>
                    <div class="study2">
                        为保证成功预订，请务必选择付款方式。付款方式仅作为记录，可修改。付款方式: <ol>
                        <li><b>现金支付（辅导结束后支付）</b></li>
                        <a href="success.php?tx=Cash">
                        <input type="submit" value="选择"></a>
                        <li><b>邮件转账（提前或辅导结束后支付）</b></li>
                        <a href="success.php?tx=EMT">
                        <input type="submit" value="选择"></a>
                        <li><b>PayPal（提前支付，可能产生手续费）</b></li>
                        <?php
                            if($unit == 0) echo 'Please contact WeChat service for your fee.';
                            else echo $button_a.$unit.$button_b.$i.$button_c;
                        ?>
                        <br><b>IMPORTANT:</b> Please make sure to return to this
                        website after payment on PayPal.<br> Note: You will be 
                        auto directed back if you log into your PayPal account, 
                        otherwise, you will have to click on a link.</ol>
                    </div>
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

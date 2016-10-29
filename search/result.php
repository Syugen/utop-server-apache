<!DOCTYPE HTML>
<?php
    if(!isset($_POST["wechatName"])) {
        header("Location: 404.html");
        exit;
    }
    
    ini_set('display_errors', 1); error_reporting(E_ALL);

    $name = $_POST["wechatName"];
    $email = $_POST["email"]."@mail.utoronto.ca";

    // 连接服务器
    $dbc = mysqli_connect('localhost', 'root', '', 'utop');
    
    $query = "SELECT * FROM timetable t, orders o WHERE username='$name' and ".
             "email='$email' and t.order_id=o.order_id";
    $result = mysqli_query($dbc, $query);
    
    $result_str = "";
    for($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_array($result);
        $result_str .= "<tr><td>".$row["date"]."</td>";
        $result_str .= "<td>".$row["time"].":00</td>";
        $result_str .= "<td>".$row["course"]."</td></tr>";
    }
    if(mysqli_num_rows($result) === 0) $result_str = "No Results Found";
    mysqli_close($dbc);
?>

<html>
    <head>
        <title>UTop Tutor Search Result</title>
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="style.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <body>
        <!--start-header-section-->
        <div class="header-section">
            <div class="continer">
                <a href="../index.php"><img src="../images/p1.jpg"></a>
                <h1>UTop Tutor<span>!</span></h1>
                <p>University of Toronto St. George</p>
            </div>
        </div>
        <!--end header-section-->

        <!--start-study-section-->
        <div class="study-section">
            <div class="container">
                <div class="study-grid">
                    <h3>Seach Results..<span>!</span><p></h3>
                    <div class="center-div">
                        <table>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Course</th>
                            </tr>
                            <?php echo $result_str;?>
                        </table>
                    </div>
                    <a href="index.html"><input type="button" value="返回"></a>
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

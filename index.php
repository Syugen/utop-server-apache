<!DOCTYPE HTML>
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

        <!--连接服务器-->
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
                    <p>专业课爆分/A+的高年级大腿, 入学奖学金和年年评为优秀学生的学霸们为您
                    提供系统性引导式讲解，帮您解决疑惑，让您考试/赶due都不慌！</p>
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
                    微信ID (非昵称，请勿输入中文字符):
                    <span id="nameErr" class="error">*</span><br>
                    <input type="text" class="text" name="name" id="name"
                    placeholder="WeChat Name" pattern="[\w.-]+" required>
                    
                    U of T 邮箱:
                    <span id="emailErr" class="error">*</span><br>
                    <input type="text" class="text" name="email" id="email"
                    placeholder="Email" pattern="\w+\.\w+@mail.utoronto.ca" required>
                    
                    课程: [<a href="course.html" target="_blank">详情</a>]
                    <span class="error">[10月22日更新CSC108 A2推荐]</span>
                    <span id="courseErr" class="error">*</span><br>
                    <select name="course" id="course" required>
                        <option value="0" selected disabled>PLEASE SELECT</option>
                        <option value="CSC108">CSC108 (单人, $30/hr)</option>
                        <option value="CSC108 (Group)">CSC108 (两人, $25/hr/人)</option>
                        <option value="CSC148">CSC148 (单人, $35/hr)</option>
                        <option value="CSC165">CSC165 (单人, $35/hr)</option>
                    </select>
                    
                    地点: (如有特殊需求请联系微信客服UtopTutor)<br>
                    Bahen Center [默认首选] / Kelly Library [周末推荐]<br>
                    Robarts Library / New College
                    [<a href="location" target="_blank">地图</a>]<br><br>
                    
                    <input type='checkbox' id='policy' required>
                    I agree to the <a href="policy.html" target="_blank">Policy</a>.
                    <span id="policyErr" class="error">*</span>
                    <span class="error">[10月1日更新]</span><br>
                    
                    <input type='checkbox' id='remember' name='remember' value='remember'>
                    记住微信、邮箱和课程<br>
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
                    <input type="submit" name="submit" id="submit" value="submit" />
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

    <script src="js/index.js"></script>
</body>
</html> 

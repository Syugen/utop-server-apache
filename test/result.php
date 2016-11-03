<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UTop Tutor Test Result</title>
    </head>

    <body>
    <?php
        function PsExecute($command, $timeout=60, $sleep=1) {
            $pid = PsExec($command);
            if(!$pid) return false;
            $cur = 0;
            while($cur < $timeout) {
                if(!PsExists($pid)) {
                    return true;
                }
                sleep($sleep);
                $cur += $sleep;
            }
            exec("kill -9 $pid", $kill_output);
            return false;
        }

        function PsExec($commandJob) {
            $command = $commandJob." > /dev/null & echo $!";
            exec($command, $result);
            $pid = (int) $result[0];
            if($pid!="") return $pid;
            return false;
        }

        function PsExists($pid) {
            exec("ps ax | grep python3 2>&1", $ps_output);
            //print_r($ps_output);
            foreach($ps_output as $row)
            {
                $row_array = explode(" ", $row);
                if($pid == $row_array[0] || $pid == $row_array[1]) return true;
            }
            return false;
        }

        function processFile($name) {
            if(isset($_FILES[$name])){
                $name_dna   = $_FILES[$name]["name"];
                $temp_name  = $_FILES[$name]["tmp_name"];
                if(!isset($name_dna) || ($name_dna != $name.".py" || !move_uploaded_file($temp_name, $name_dna))) {
                    return false;
                }
            }
            return true;
        }

        // 设置php debug显示选项，无错误时不显示；有错误时显示
        //ini_set('display_errors', 1); error_reporting(E_ALL);

        // 检查网页刷新cookie，有则正常，并删除；没有则说明刷新过
        if(!isset($_POST["proofFromIndex"]) || !$_COOKIE["utopTest"])
            header("Location: ../404.html");
        setcookie("utopTest", "", time() - 86400);

        $time = microtime(true);
        mkdir("$time");
        chdir("$time") or die("Failed to change directory.");
        $log = "";

        // 上传文件失败
        if(!processFile("dna") or !processFile("palindromes")) {
            echo "<h2>文件上传失败</h2>";
            echo "确定两个文件都上传了？文件名没错？然后再试一次吧。";
            $log .= date("Y/m/d H:i:s")." Failed to upload.                                                                                ";
        } else { // 上传文件成功
            // python3测试
            copy("../a2_test.py", "./a2_test.py");
            $output = PsExecute("python3 a2_test.py 2> error", 2);
            if(!$output) {
                // 超时
                echo "<h2>死循环！</h2>";
                echo "请检查你的代码，确保没有死循环（尤其是while循环）。";
                $log .= date("Y/m/d H:i:s")." Infinite Loop.                                                                                   ";
            } else if(!file_exists("show_result.txt")) {
                // 编译错误
                $content = file_get_contents("error") or die("Cannot open error");
                echo "<h2>你的代码无法编译</h2>请确保代码中无语法错误再提交。<br>";
                echo "错误信息如下：<br><code><pre>$content</pre></code>";
                $log .= date("Y/m/d H:i:s")." Failed to compile.                                                                               ";
            } else {
                // 成功
                $content = file_get_contents("show_result.txt") or die("Cannot open show_result.txt");
                $result = file_get_contents("log_result.txt") or die("Cannot open log_result.txt");
                echo "<h2>Your result:</h2><code><pre>$content</pre></code>";
                $log .= date("Y/m/d H:i:s")." $result ";
            }
        }

        // 记录信息
        $file = fopen("../all_test_results.txt", "a") or die("Cannot all_test_results.txt.");
        fwrite($file, $log);
        foreach (json_decode($_POST["userInfo"], true) as $key => $value) {
            fwrite($file, $value."\t");
        }
        fwrite($file, $_SERVER["REMOTE_ADDR"]."\n");
        fclose($file);

        chdir("..");
        exec("rm -rf $time");
    ?>
    <p><a href="./">返回重新测试</a><br>[请勿使用浏览器的返回按钮]</p>
    <p>
        我们的客服小助手的微信号是UtopTutoring，如有发现bug欢迎与他联系<br>
        但是他回答不了这个Assignment的问题，也没法提供测试的具体内容……
    </p>
    <p>课程辅导报名网址：<a href="../index.php">utoptutoring.ml</a></p>
    </body>
</html>

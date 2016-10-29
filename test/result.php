<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UTop Tutor Test Result</title>
    </head>

    <body>
    <?php
        function PsExecute($command, $timeout=60, $sleep=2) {
            $pid = PsExec($command);
            if(!$pid) return false;

            $cur = 0;
            while($cur < $timeout) {
                sleep($sleep);
                $cur += $sleep;
                if(!PsExists($pid)) {
                    return true;}
            }
            PsKill($pid);
            return false;
        }

        function PsExec($commandJob) {
            $command = $commandJob." > /dev/null & echo $!";
            exec($command ,$op);
            $pid = (int)$op[0];
            if($pid!="") return $pid;
            return false;
        }

        function PsExists($pid) {
            exec("ps ax | grep $pid 2>&1", $output);
            foreach($output as $row)
            {
                $row_array = explode(" ", $row);
                if($pid == $row_array[0] || $pid == $row_array[1]) return true;
            }
            return false;
        }

        function PsKill($pid) {
            exec("kill -9 $pid", $output);
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
        if(!isset($_COOKIE["csc108test_index"]))
            header("Location: ../404.html");
            setcookie("csc108test_index", "", time()-86400);

        // 上传文件失败
        if(!processFile("dna") or !processFile("palindromes")) {
            echo "<h2>文件上传失败</h2>";
            echo "确定两个文件都上传了？文件名没错？然后再试一次吧。";
            $file = fopen("all_test_results.txt", "a") or die("Cannot open file.");
            fwrite($file, date("Y/m/d H:i:s")." Failed to Upload. ".$_SERVER["REMOTE_ADDR"]."\n");
            fclose($file);
        } else { // 上传文件成功
            // 记录用户ip
            $file = fopen("ip.txt", "w") or die("Cannot open file.");
            fwrite($file, $_SERVER["REMOTE_ADDR"]);
            fclose($file);

            // python3测试
            $rs = PsExecute("python3 a2_test.py 2> error.txt", 6);

            if(!$rs) {
                // 超时
                echo "<h2>死循环！</h2>";
                echo "幸好添加了防止死循环的代码，脆弱的服务器不会因此瘫痪了^_^<br>";
                echo "请检查你的代码，确保没有死循环~（尤其是while循环）";
                $file = fopen("all_test_results.txt", "a") or die("Cannot open file.");
                fwrite($file, date("Y/m/d H:i:s")." Infinite Loop. ".$_SERVER["REMOTE_ADDR"]."\n");
                fclose($file);
            } else if(file_exists("test_result.txt")) {
                // 成功
                $file = fopen("test_result.txt", "r");
                $content = fread($file, filesize("test_result.txt"));
                echo "<h2>Your result:</h2><code><pre>".$content."</pre></code>";
                fclose($file);
                unlink("test_result.txt");
            } else {
                // 编译错误
                $file = fopen("error.txt", "r");
                $content = fread($file, filesize("error.txt"));
                echo "<h2>你的代码无法编译</h2>请确保代码中无语法错误再提交。<br>";
                echo "错误信息如下：<br><code><pre>".$content."</pre></code>";
                $file = fopen("all_test_results.txt", "a") or die("Cannot open file.");
                fwrite($file, date("Y/m/d H:i:s")." Failed to Compile. ".$_SERVER["REMOTE_ADDR"]."\n");
                fclose($file);
            }
        }
//        if(file_exists("dna.py")) unlink("dna.py");
//        if(file_exists("palindromes.py")) unlink("palindromes.py");
        if(file_exists("ip.txt")) unlink("ip.txt");
    ?>
    <p><a href="./">返回重新测试</a></p>
    <p>课程辅导报名网址：<a href="../index.php">utoptutoring.ml</a></p>
    </body>
</html>

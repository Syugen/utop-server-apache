<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UTop Tutor Test Result</title>
    </head>
    
    <body>
    <?php
        // 设置php debug显示选项，无错误时不显示；有错误时显示
        ini_set('display_errors', 1); error_reporting(E_ALL);
            
        // 检查网页刷新cookie，有则正常，并删除；没有则说明刷新过
        if(!isset($_COOKIE["csc108test_index"]))
            header("Location: ../404.html");
        setcookie("csc108test_index", "", time()-86400);

        // 上传文件，未上传、文件名错、创建文件出错则报错        
        $upload_fail = 0;
        if(isset($_FILES['dna'])){
            $name_dna   = $_FILES['dna']['name'];
            $temp_name  = $_FILES['dna']['tmp_name'];
            if(!isset($name_dna) || $name_dna != "dna.py" || !move_uploaded_file($temp_name, $name_dna)){
                echo 'Upload dna.py failed<br>';
                $upload_fail = 1;
            }
        }
        if(isset($_FILES['palindromes'])){
            $name_pal   = $_FILES['palindromes']['name'];
            $temp_name  = $_FILES['palindromes']['tmp_name'];
            if(!isset($name_pal) || $name_pal != "palindromes.py" || !move_uploaded_file($temp_name, $name_pal)){
                echo 'Upload palindromes.py failed<br>';
                $upload_fail = 1;
            }
        }
        
        // 上传成功
        if(!$upload_fail){
            // 记录用户ip
            $file = fopen("ip.txt", "w") or die("Cannot open file.");
            fwrite($file, $_SERVER["REMOTE_ADDR"]);
            fclose($file);
            
            // python3测试
            exec("python3 a2_test.py 2> error.txt");
            
            // 运行成功（无编译错误）
            if(file_exists("test_result.txt")) {
                $file = fopen("test_result.txt", "r");
                $content = fread($file, filesize("test_result.txt"));
                echo "<h2>Your result:</h2><code><pre>".$content."</pre></code>";
                fclose($file);
                unlink("test_result.txt");
            } else {
                $file = fopen("error.txt", "r");
                $content = fread($file, filesize("error.txt"));
                unlink("error.txt");
                echo "<h2>你的代码无法编译</h2>请确保代码中无语法错误再提交。<br>";
                echo "错误信息如下：<br><code><pre>".$content."</pre></code>";
            }
        }
        if(file_exists("dna.py")) unlink("dna.py");
        if(file_exists("palindromes.py")) unlink("palindromes.py");
        if(file_exists("ip.txt")) unlink("ip.txt");
    ?>
    <p><a href="./">返回重新测试</a></p>
    <p>课程辅导报名网址：<a href="../index.php">utoptutoring.ml</a></p>
    </body>
</html>

<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UTop Tutor Test Result</title>
</head>

<body>
<?php
ini_set('display_errors', 1); error_reporting(E_ALL);
	if(isset($_COOKIE["csc108test"])) {
		echo "You have already submitted once in the last 24 hours.<br>";
		echo "Please try again later.<br>";
	} else if(!isset($_COOKIE["csc108test_index"]))
		header("Location: ../404.html");
	else {
		setcookie("csc108test_index", "", time()-86400);
$upload_fail = 0;
if(isset($_FILES['dna'])){
    $name       = $_FILES['dna']['name'];
    $temp_name  = $_FILES['dna']['tmp_name'];
    if(!isset($name) || empty($name) || !move_uploaded_file($temp_name, './'.$name)){
            echo 'Upload dna.py failed<br>';
		$upload_fail = 1;
    }
};
if(isset($_FILES['palindromes'])){
    $name       = $_FILES['palindromes']['name'];
    $temp_name  = $_FILES['palindromes']['tmp_name'];
    if(!isset($name) || empty($name) || !move_uploaded_file($temp_name, './'.$name)){
            echo 'Upload palindroms.py failed<br>';
		$upload_fail = 1;
    }
};
if(!$upload_fail){
		exec("python3 a2_test.py 2> error.txt");
		unlink("dna.py");
		unlink("palindromes.py");
		if(file_exists("test_result.txt")) {
//			setcookie("csc108test", "csc108test", time()+86400);
			$file = fopen("test_result.txt", "r");
			$content = fread($file, filesize("test_result.txt"));
			echo "<h2>Your result:</h2><code><pre>".$content."</pre></code>";
			fclose($file);
			unlink("test_result.txt");
//			if(file_exists("error.txt")) unlink("error.txt");
		} else {
			$file = fopen("error.txt", "r");
			$content = fread($file, filesize("error.txt"));
			unlink("error.txt");
			echo "<h2>你的代码无法编译</h2>";
			echo "请确保代码中无语法错误再提交。<br>";
//			echo "<br>You don't have to wait 24 hours to resubmit.<br>";
			echo "错误信息如下：<br><code><pre>";
			echo $content."</pre></code>";
		}
	}
}
?>
<br><a href="./">返回重新测试</a>
<br><br>课程辅导报名网址：<a href="../index.php">utoptutoring.ml</a>
</body>
</html>

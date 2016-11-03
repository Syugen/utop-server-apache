<!DOCTYPE HTML">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UTop Tutor Test</title>
    </head>

    <body>
        <?php
            // csc108test_index是测试页面未刷新的cookie
            setcookie("utopTest", "utopTest", time() + 86400);
        ?>

        <h3>CSC108 Assignment 2免费测试</h3>
        <form name="form" id="form" method="post" action="result.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>上传palindromes.py:</td>
                    <td><input type="file" name="palindromes" id="palindromes"></td>
                </tr>
                <tr>
                    <td>上传dna.py:</td>
                    <td><input type="file" name="dna" id="dna"></td>
                </tr>
            </table>
            <p>
                说明：点击提交按钮，表明你已知晓你的代码将会加密传输给utoptutoring.ml服务器；<br>
                服务器在测试完你的代码后会立刻（在你看到结果之前）删除你传送的文件。
            </p>
            <input type="hidden" id="proofFromIndex" name="proofFromIndex">
            <input type="hidden" id="userInfo" name="userInfo">
            <input type="submit" id="submit" name="submit"value="提交">
        </form>
        <p>课程辅导报名网址：<a href="../index.php">utoptutoring.ml<p>
        <img src="http://hitwebcounter.com/counter/counter.php?page=6518574&style=0024&nbdigits=6&type=ip&initCount=0" title="" Alt="" border="0" ><br>
        <img src="http://hitwebcounter.com/counter/counter.php?page=6518573&style=0024&nbdigits=6&type=page&initCount=0" title="" Alt="" border="0" >
        <script src="../js/browser.js"></script>
        <script>
            document.getElementById("form").onsubmit = function() {
                document.getElementById("submit").disabled = true;
            };console.log(document.getElementById("userInfo"));
        </script>
    </body>
</html>

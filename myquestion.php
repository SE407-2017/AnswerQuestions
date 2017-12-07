<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>您提出的问题</title>
    <link rel="stylesheet" type="text/css" href="我提出的问题.css"><!--外部样式-->
    <script>
        function over(obj) {
            obj.style.cssText="animation:toRotateOne 1s forwards";
        }

        function out(obj) {
            obj.style.cssText="animation:toRotateTwo 1s forwards";
        }
    </script>
</head>
<body>
    <h1>课业难题交流</h1>

    <div id="first" onclick=window.open("首页.html") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textOne">
        <p>退出登录</p>
    </div>

    <div id="second" onclick=window.open("提问.html") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textTwo">
        <p>我要提问</p>
    </div>

    <div id="three" onclick=window.open("个人中心.html") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textThree">
        <p>个人中心</p>
    </div>

    <div id="four" onclick=window.open("搜索.html") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textFour">
        <p>我要搜索</p>
    </div>

    <table style="margin-left: 30px;float: left">
        <tr style="text-align: left">
            <th width="400px" style="float: left;margin-left: 20px; border:1px solid; border-radius:3px; text-align:center;" >内容：</th>
            <th width="100px" style="border:1px solid; border-radius:3px; text-align:center;">提问人：</th>
            <th width="100px" style="border:1px solid; border-radius:3px; text-align:center;">回复数目：</th>
            <th width="100px" style="border:1px solid; border-radius:3px; text-align:center;">是否解决：</th>
            <th width="100px" style="border:1px solid; border-radius:3px; text-align:center;">提问时间：</th>
        </tr>

        <?php
            $con=mysqli_connect("localhost","root","","users");
            if (!$con){
                die("连接失败:".mysqli_connect_error());
            }

            session_start();
            $id=$_SESSION['G_id'];
            $result=mysqli_query($con, "select * from problem where people='$id'");//显示当前用户已提出的所有问题
            $number=mysqli_num_rows($result);
            for ($x=1;$x<=$number;$x++)
            {
                $row=mysqli_fetch_array($result);
                echo "<tr>";
                $text=$row["text_content"];
                echo "<td>"."<a href='answer_question.php?content=$text'>".$text."</a>"."</td>";
                echo "<td>".$id."</td>";
                echo "<td>".$row['reply_num']."</td>";
                echo "<td>".$row['state']."</td>";
                echo "<td>".$row['time']."</td>";
                echo "</tr>";
            }
            mysqli_close($con);
        ?>
    </table>
</body>
</html>
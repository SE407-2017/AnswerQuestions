<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>您提出的问题</title>
    <link rel="stylesheet" type="text/css" href="我提出&回答的问题.css">
    <link rel="stylesheet" type="text/css" href="public.css"><!--外部样式-->
    <script type="text/javascript" src="动画.js"></script>
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

    <div id="five" onclick=window.open("shouye(denglu).php") onmouseover="over(this)" onmouseout="out(this)" ></div>
    <div id="textFive">
        <p>返回首页</p>
    </div>

    <table style="margin-left: 30px;float: left" >
        <tr style="text-align: left">
            <th width="400px" style="float: left;margin-left: 20px; border:1px solid; border-radius:3px; text-align:center;" >问题内容:</th>
            <th width="400px" style="border:1px solid; border-radius:3px; text-align:center;">回复内容:</th>
            <th width="100px" style="border:1px solid; border-radius:3px; text-align:center;">回答人:</th>
            <th width="100px" style="border:1px solid; border-radius:3px; text-align:center;">回答时间:</th>
        </tr>

		<?php
			$con=mysqli_connect("localhost","root","","users");
			if (!$con){
				die("连接失败:".mysqli_connect_error());
			}
				
			session_start();
			$id=$_SESSION['G_id'];
			$result=mysqli_query($con, "select * from reply where people='$id'");//显示当前用户已提出的所有问题
			$number=mysqli_num_rows($result);
			for ($x=1;$x<=$number;$x++)
			{
				$row=mysqli_fetch_array($result);
				echo "<tr>";
				$text=$row["problem_text_content"];
				echo "<td>"."<a href='answer_question.php?content=$text'>".$text."</a>"."</td>";
				echo "<td>".$row["reply_text_content"]."</td>";
				echo "<td>".$id."</td>";
				echo "<td>".$row['time']."</td>";
				echo "</tr>";	
			}
			mysqli_close($con); 
		?>
    </table>
</body>
</html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我要搜索"<?php echo $_POST["course"];?>"的结果</title>
    <link rel="stylesheet" type="text/css" href="搜索.css">
    <link rel="stylesheet" type="text/css" href="public.css"><!--外部样式-->
    <script type="text/javascript" src="动画.js"></script>
</head>

<body>
    <h1>课业难题交流</h1>

    <div id="first" onclick=window.open("首页（待登录）.html") onmouseover="over(this)" onmouseout="out(this)" ></div>
    <div id="textOne">
        <p>退出登录</p>
    </div>

    <div id="second" onclick=window.open("个人中心.html") onmouseover="over(this)" onmouseout="out(this)" ></div>
    <div id="textTwo">
        <p>个人中心</p>
    </div>

    <div id="three" onclick=window.open("shouye(denglu).php") onmouseover="over(this)" onmouseout="out(this)" ></div>
    <div id="textThree">
        <p>我要搜索</p>
    </div>

    <center>
        <form action="sousuo.php" method="post">
            <br>
            <input type="text" placeholder="在这里搜索课程或问题" name="course" class="search">
            <select name="select_type" class="selection">
                <option value="0" >课程</option>
                <option value="1" >问题</option>
            </select>
            <br><br>
            <select name="shaixuan" class="selection"><!--筛选-->
            <option value="0">按提问时间升序</option>
            <option value="1">按提问时间降序</option>
            <option value="2">按回复数升序</option>
            <option value="3">按回复数降序</option>
            <option value="4">已解决</option>
            <option value="5">未解决</option>
            <option value="6">按点赞数升序</option>
            <option value="7">按点赞数降序</option>
            </select>
            <br><br>
            <input type="submit" value="搜索" class="upLoad">
        </form>
    </center><!--提供搜索功能，可以搜索课程，也可以直接搜索问题。可以选择搜索的排序。搜索课程时，会显示出该课程中相应的问题。-->

    <p><?php
	if ($_POST["select_type"]=="0")
	{
		echo "欢迎来到".$_POST["course"]."课业难题交流区：";
	}
	else
	{
		echo "以下是".$_POST["course"]."的搜索结果:";
	}
	?></p>

    <table>
        <tr>
            <th width="600px">内容</th>
            <th width="100px">提问人</th>
            <th width="100px">回复数目</th>
            <th width="100px">是否解决</th>
            <th width="200px">提问时间</th>
			<th width="100px">点赞数</th>
        </tr>
		<?php
			$con=mysqli_connect("localhost","root","","users");
			if (!$con){
				die("连接失败:".mysqli_connect_error());
			}
			$course=$_POST["course"];

			if ($_POST["select_type"]=="0")
			{
			//筛选排序
			if ($_POST["shaixuan"]=="0")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY time DESC");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="1")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY time ");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="2")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY reply_num DESC");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="3")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY reply_num ");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="4")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY state ");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="5")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY state DESC");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="6")
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY praise_num DESC");
				$number=mysqli_num_rows($result);
			}
			else
			{
				$result = mysqli_query($con,"SELECT * FROM problem where course='$course' ORDER BY praise_num");
				$number=mysqli_num_rows($result);
			}
			for ($x=1;$x<=$number;$x++)
			{
				$row=mysqli_fetch_array($result);
				echo "<tr>"."<td>";
				$text=$row["text_content"];
				echo "<a style='margin-left: 30px' target='_blank' href='answer_question.php?content=$text'>".$text."</a>"."</td>";
				echo "<td>".$row['people']."</td>";
				echo "<td>".$row['reply_num']."</td>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['time']."</td>";
				echo "<td>".$row['praise_num']."</td>";
				echo "</tr>";
			}
			}

			else
			{


			//筛选排序
			if ($_POST["shaixuan"]=="0")
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY time");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="1")
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY time DESC");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="2")
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY reply_num");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="3")
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY reply_num  DESC");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="4")
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY state");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="5")
			{
				$result = mysqli_query($con,"SELECT * FROM problem  ORDER BY state DESC");
				$number=mysqli_num_rows($result);
			}
			elseif ($_POST["shaixuan"]=="6")
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY praise_num DESC");
				$number=mysqli_num_rows($result);
			}
			else
			{
				$result = mysqli_query($con,"SELECT * FROM problem ORDER BY praise_num");
				$number=mysqli_num_rows($result);
			}
			for ($x=1;$x<=$number;$x++)
			{
				$row=mysqli_fetch_array($result);
				$text=$row["text_content"];
				$is_exist=is_int(strpos($text,$course));//搜索问题字符串匹配

				if($is_exist)
				{
				echo "<tr>"."<td>";

				echo "<a style='margin-left: 30px' target='_blank' href='answer_question.php?content=$text'>".$text."</a>"."</td>";
				echo "<td>".$row['people']."</td>";
				echo "<td>".$row['reply_num']."</td>";
				echo "<td>".$row['state']."</td>";
				echo "<td>".$row['time']."</td>";
				echo "<td>".$row['praise_num']."</td>";
				echo "</tr>";
				}
			}
			}
			mysqli_close($con); 
		?>
    </table>
</body>
</html>

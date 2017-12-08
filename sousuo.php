<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索"<?php echo $_POST["course"];?>"的结果</title>
</head>
<body>
<form action="sousuo.php" method="post">
    <p style="text-align: center;font-family: 微软雅黑;font-size: 24px">xxxx学习交流平台</p>
    <a style="float: right" href="个人中心.html">[用户id]</a>
    <br/>
    <a href="提问.html" target="_blank" style="margin-right: 70px;float: right">[我要提问]</a>
    <br/>
    <br/>
    <input type="text" size="30" style="margin-left: 30px" placeholder="高等数学A" name="course">
    <select name="select_type" style="margin-left: 20px;width: 80px" >
        <option value="0">课程</option>
        <option value="1">问题</option>
    </select>    
	<select name="shaixuan" style="margin-left: 30px"><!--筛选-->
        <option value="0">按提问时间升序</option>
        <option value="1">按提问时间降序</option>
        <option value="2">按回复数升序</option>
        <option value="3">按回复数降序</option>
        <option value="4">已解决</option>
        <option value="5">未解决</option>
		<option value="6">按点赞数升序</option>
		<option value="7">按点赞数降序</option>
    </select>
	<input type="submit" style="margin-left: 20px" value="搜索">

    <p style="margin-left: 30px;font-family: 微软雅黑" ><?php 
	if ($_POST["select_type"]=="0")
	{
		echo "欢迎来到".$_POST["course"]."课业难题交流区：";
	}
	else
	{
		echo "以下是".$_POST["course"]."的搜索结果:";
	}
	?></p>
    <table style="margin-left: 30px" >
        <tr style="text-align: left">
            <th width="600px" style="float: left;margin-left: 20px">内容</th>
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
    <br/><br/><br/>
    <hr style="margin-bottom: 50px ">
    <p style="text-align: center;font-family: 微软雅黑;margin-top: 10px">我们的联系方式：xxxxxxxx</p>
</form>
</body>
</html>
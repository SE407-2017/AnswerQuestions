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
	<input type="submit" style="margin-left: 20px" value="搜索">
</form>
<form>
    <p style="margin-left: 30px;font-family: 微软雅黑" >欢迎来到高等数学A课业难题交流区：</p>
    <label style="margin-left: 30px" >[筛选]</label>
    <select name="yhid" style="margin-left: 20px" >
        <option>按提问时间升序</option>
        <option>按提问时间降序</option>
        <option>按需求度升序</option>
        <option>按需求度降序</option>
        <option>已解决</option>
        <option>未解决</option>
    </select>
    <table style="margin-left: 30px" >
        <tr style="text-align: left">
            <th width="600px" style="float: left;margin-left: 20px">内容</th>
            <th width="100px">提问人</th>
            <th width="100px">回复数目</th>
            <th width="100px">是否解决</th>
            <th width="100px">提问时间</th>
        </tr>
		<?php
			$con=mysqli_connect("localhost","root","","users");
			if (!$con){
				die("连接失败:".mysqli_connect_error());
			}
			
			if ($_POST["select_type"]=="0")
			{
				$course=$_POST["course"];
				$result=mysqli_query($con, "select * from problem where course='$course'");//显示当前课程的所有问题
				$number=mysqli_num_rows($result);
			
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
					echo "</tr>";	
				}
			}
	    		//新添加的部分调用全文搜索模块
			else
			{
				$result=exec("C:/wamp/www/search.py {$course}");
				if ($result['hits']['total']==0) {
					echo "无结果";
				}
				else {
					$hits=$result['hits']['hits'];
					foreach ($hits as $hit)
					{
						echo "<tr>"."<td>";
						$text=$hit['_source']['content'];
						echo "<a style='margin-left: 30px' target='_blank' href='answer_question.php?content=$text'>".$text."</a>"."</td>";
						echo "<td>".$hit['response']."</td>";
						echo "<td>".$hit['reply_num']."</td>";
						echo "<td>".$hit['response_state']."</td>";
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

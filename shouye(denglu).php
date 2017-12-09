<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="首页（登录）.css">
    <link rel="stylesheet" type="text/css" href="public.css"><!--外部样式-->
    <script type="text/javascript" src="动画.js"></script>
</head>
<body>
    <h1>课业难题交流</h1>

    <div id="first" onclick=window.open("个人中心.html") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textOne">
        <p>个人中心</p>
    </div>

    <div id="second" onclick=window.open("提问.html") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textTwo">
        <p>我要提问</p>
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

        <br>
        <p>热点讨论区：</p>
        <img src="picture_dissicion.jpg">

        <table><!--显示出需求度最高的5个问题-->
            <tr>
                <th width="400px" style="float: left;" >内容：</th>
                <th width="100px">提问人：</th>
                <th width="100px">回复数目：</th>
                <th width="100px">是否解决：</th>
                <th width="100px">提问时间：</th>
                <th width="100px">需求人数：</th>
            </tr>

            <?php
            $con=mysqli_connect("localhost","root","","users");
            if (!$con){
                die("连接失败:".mysqli_connect_error());
            }

            $result = mysqli_query($con,"SELECT * FROM problem ORDER BY reply_num DESC");
            $num=mysqli_num_rows($result);

            if ($num>4)
            {
                $number=4;
            }
            else
            {
                $number=$num;
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

            mysqli_close($con);
            ?>
        </table>
</body>
</html>
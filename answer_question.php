<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>回答问题</title>
    <link rel="stylesheet" type="text/css" href="回答问题.css">
    <link rel="stylesheet" type="text/css" href="public.css"><!--外部样式-->
    <script type="text/javascript" src="动画.js"></script>
</head>
<body>
    <h1>课业难题交流</h1>

    <div id="first" onclick=window.open("首页（待登录）.html") onmouseover="over(this)" onmouseout="out(this)"></div>
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

    <div id="four" onclick=window.open("shouye(denglu).php") onmouseover="over(this)" onmouseout="out(this)"></div>
    <div id="textFour">
        <p>我要搜索</p>
    </div>

    <center>
        <div class="background">
            <center>
                <div class="transbox">
                <center>
                    <form action="huida.php" method="post"  enctype="multipart/form-data">
                        <!--显示当前问题的内容-->
                        <input type="text" value="提问人：<?php
                            $con=mysqli_connect("localhost","root","","users");
                            if (!$con){
                                die("连接失败:".mysqli_connect_error());
                            }
                            $text=$_GET["content"];

                            session_start();
                            $_SESSION['G_content']=$text;//将问题内容设为全局变量便于在回答环节储存
                            $result=mysqli_query($con, "select * from problem where text_content='$text'");//显示当前提问的内容
                            $row=mysqli_fetch_array($result);
                            echo $row["people"];
                        ?>" size="49">
                        <br>
                        <input type="text" value="日期：<?php
                            echo $row["time"];////显示当前提问的时间

                        ?>" size="49">
                        <br>
                        <textarea rows="5" cols="50" readonly><?php echo $_GET["content"];?></textarea>
                        <br>


                        <!--显示图片-->
                        <?php
                            $url=$row["file_url"];
                            if ($url!="")
                            {
                            echo "<img src=$url width='300px'>";
                            }
                        ?>

                        <p style="color:white;">我也有同样的疑问:</p>
                        <?php echo $row["praise_num"]."   "."<a href='dianzan.php?content=$text'>"."+1"."</a>"; ?>
                        <img src="picture_question.jpg">

                        <br>
                        <br>
                        <!--显示当前问题所有回答的内容-->
                        <?php
                            $rnum=$row["reply_num"];
                            $resultx=mysqli_query($con, "select * from reply where problem_text_content='$text'");//显示当前问题所有回答
                            for ($x=1;$x<=$rnum;$x++)
                            {
                                $rowx=mysqli_fetch_array($resultx);
                                $r_people=$rowx["people"];//设定当前问题的回答人
                                $r_time=$rowx["time"];
                                $r_url=$rowx["file_url"];
                                echo "<input type='text' value='回答人：$r_people' size='49'>";
                                echo "<br>";
                                echo "<input type='text' value='日期：$r_time' size='49'>";
                                echo "<br>";
                                echo "<textarea rows='5' cols='50' readonly>".$rowx["reply_text_content"]."</textarea>";
                                echo "<br>";
                                if ($r_url!="")
                                {
                                    echo "<img src=$r_url width='300px'>";
                                }
                                echo "<br>"."<p style='color:white;'>"."回答很赞:"."</p>".$rowx["praise_num"]."   "."<a href='dianzan2.php?content=$text'>"."+1"."</a>"."<br>"."<br>";
                            }
                            mysqli_close($con);
                            ?>


                            <textarea rows="5" cols="50" placeholder="在这里输入你要回复的内容（不多于500字）" maxlength="500" name="textarea" ></textarea>
                            <br>
                            <label for="file" style="cursor:pointer;"></label>
                   	 	    <input type="file" name="file" id="file" style="cursor:pointer;">
                            <input type="submit" name="submit" value="发表" class="upload">
                        </form>
                    </center>
                </div>
            </center>
        </div>
    </center><!--提供回答功能，回答时可以上传图片。可以通过点击来增加问题的需求度，可以通过点击来增加回答的点赞数-->
</body>
</html>
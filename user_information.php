<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link rel="stylesheet" type="text/css" href="个人信息.css"><!--外部样式-->
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

    <div id="itemOne">
        <p>用户名:</p>
			<?php
				session_start();
				echo $_SESSION['G_id'];//显示用户名
			?>
	</div>
	<br>

    <div id="itemTwo">
        <p>姓名：</p>
			<?php
				echo $_SESSION['G_name'];//显示姓名
			?>
    </div>
    <br>

    <div id="itemThree">
        <p>学号：</p>
			<?php
				echo $_SESSION['G_num'];//显示学号
			?>
	</div>
</body>
</html>
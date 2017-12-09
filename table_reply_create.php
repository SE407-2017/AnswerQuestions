<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="users";
// 创建连接
$con = mysqli_connect($servername, $username, $password,$dbname);
// 检测连接
if (!$con){
	die("连接失败:".mysqli_connect_error());
}
//mysqli_query($con,"set Names 'UTF8'");
// 创建数据表
$sql = "create table reply(
problem_text_content varchar(500),
reply_text_content varchar(500),
file_url varchar(200),
people varchar(12),
time varchar(25),
praise_num int
)";

if (mysqli_query($con, $sql)) {
	echo "数据表创建成功";
} else {
	echo "数据表创建失败:".mysqli_error($con);
}


mysqli_close($con);
?> 
<?php
$con=mysqli_connect("localhost","root","","users");
if (!$con){
	die("连接失败:".mysqli_connect_error());
}
mysqli_query($con,"set Names 'UTF8'");

$id=$_GET["user"];
$password=$_GET["password"];

$result=mysqli_query($con, "select * from person where user_id='$id'");

$row=mysqli_fetch_array($result);

if (mysqli_num_rows($result)==0)
{
	echo "<script language=javascript>alert('用户名为空或不存在');history.go(-1);</script>";
	return;
}

if ($row["user_password_confirm"]!=$password)
{
	echo "<script language=javascript>alert('密码错误');history.go(-1);</script>";
	return;
}
else
{
	session_start();
	$_SESSION['G_id']=$id;//设为全局，便于在其他界面操作显示
	$_SESSION['G_name']=$row["user_name"];
	$_SESSION['G_num']=$row["user_num"];
	header("location:首页(登录).html");
}
	

mysqli_close($con);

?>
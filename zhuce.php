<?php
error_reporting(0);
$con=mysqli_connect("localhost","root","","users");
if (!$con){
	die("连接失败:".mysqli_connect_error());
}

mysqli_query($con,"set Names 'UTF8'");

$shenfen=$_POST["user_shenfen"];
$id=$_POST["user_id"];
$password_input=$_POST["user_password_input"];
$password_confirm=$_POST["user_password_confirm"];
$name=$_POST["user_name"];
$num=$_POST["user_num"];

if ($shenfen!="student" and $shenfen!="assistant" and $shenfen!="teacher")
{
	echo "<script language=javascript>alert('请选择身份');history.go(-1);</script>";//检验身份是否为空
	return;
}

if ($id=="")
{
	echo "<script language=javascript>alert('用户名不能为空');history.go(-1);</script>";//检验用户名是否为空
	return;
}
else
{
	$result1=mysqli_query($con, "select * from person where user_id='$id'");
	if (mysqli_num_rows($result1)>=1) //检验用户名是否已被注册
	{
		echo "<script language=javascript>alert('用户名已被注册');history.go(-1);</script>";
		return;
	}
}
	
if ($password_input=="")
{
	echo "<script language=javascript>alert('密码不能为空');history.go(-1);</script>";//检验密码是否为空
	return;
}

if ($password_input!=$password_confirm)
{
	echo "<script language=javascript>alert('两次密码不一样');history.go(-1);</script>";//检验密码相同
	return;
}

if ($name=="")
{
	echo "<script language=javascript>alert('姓名不能为空');history.go(-1);</script>";//检验姓名是否为空
	return;
}

if ($num=="")
{
	echo "<script language=javascript>alert('学号不能为空');history.go(-1);</script>";//检验学号是否为空
	return;
}
else
{
	$result2=mysqli_query($con, "select * from person where user_num='$num'");
	if (mysqli_num_rows($result2)>=1) //检验学号是否已被注册
	{
		echo "<script language=javascript>alert('学号已被注册');history.go(-1);</script>";
		return;
	}
}

mysqli_query($con,"set names 'utf8'");

//向表中插入数据
$sql="insert into person (user_shenfen,user_id,user_password_confirm,user_name,user_num)
values('$shenfen','$id','$password_confirm','$name','$num')";

//显示是否注册成功
if (mysqli_query($con, $sql))
{
	echo "注册成功!";
}
else
{
	echo "注册失败!".mysqli_error($con);
}
mysqli_close($con);
?>

<a href="登录.html">返回登录界面<a>
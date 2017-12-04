<?php

$servername = "localhost";
$username = "root";
$password = "";

// 创建连接
$con = mysqli_connect($servername, $username, $password);
// 检测连接
if (!$con){
	die("连接失败:".mysqli_connect_error());
}
mysqli_query($con,"set Names 'UTF8'");

$sql="create database users";

// 创建数据库
if (mysqli_query($con, $sql)) {
	echo "数据库创建成功";
} else {
	echo "Error creating database:".mysqli_error($con);
}



mysqli_close($con);
?> 

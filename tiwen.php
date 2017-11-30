<?php
$con=mysqli_connect("localhost","root","","users");
if (!$con){
	die("连接失败:".mysqli_connect_error());
}

$course=$_POST["course"];
$text_content=$_POST["content"];

if ($course=="")
{
	echo "<script language=javascript>alert('请选择所属课程');history.go(-1);</script>";//检验课程分类是否为空
	return;
}
if ($text_content=="")
{
	echo "<script language=javascript>alert('提问内容不得为空');history.go(-1);</script>";//检验提问内容是否为空
	return;
}
else
{
	$result1=mysqli_query($con, "select * from problem where text_content='$text_content'");
	if (mysqli_num_rows($result1)>=1) //检验用户是否重复提出了问题
	{
		echo "<script language=javascript>alert('请不要重复提出问题');history.go(-1);</script>";
		return;
	}
}
//文件存储
$filename=$_FILES["file"]["name"];
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名

if ($filename!="")
{
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "<script language=javascript>alert('上传失败');history.go(-1);</script>";
		return;
    }
    else
    {
        // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
        move_uploaded_file($_FILES["file"]["tmp_name"], "picture/" . $_FILES["file"]["name"]);
		$file_url="picture/".$_FILES["file"]["name"];
    }
}
else
{
    echo "<script language=javascript>alert('非法的文件格式');history.go(-1);</script>";
	return;
}
}
else
{
	$file_url="";
}
session_start();
$people=$_SESSION['G_id'];


$reply_num=0; //初始化回复数为0

$state="未解决"; //初始化问题状态为未解决

$time=date("Y/m/d h:i:s");

//向表中插入数据
$sql="insert into problem(course,text_content,file_url,people,reply_num,state,time)
values('$course','$text_content','$file_url','$people','$reply_num','$state','$time')";

mysqli_query($con, $sql);

header("location:首页(登录).html");
mysqli_close($con);
?>
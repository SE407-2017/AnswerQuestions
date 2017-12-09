<?php
$con=mysqli_connect("localhost","root","","users");
if (!$con){
	die("连接失败:".mysqli_connect_error());
}

$reply_text_content=$_POST["textarea"];
if ($reply_text_content=="")
{
	echo "<script language=javascript>alert('回答内容不得为空');history.go(-1);</script>";//检验回答内容是否为空
	return;
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


$problem_text_content=$_SESSION['G_content'];
$result=mysqli_query($con, "select * from problem where text_content='$problem_text_content'");//让回复数目+1
$row=mysqli_fetch_array($result);
$new_reply_num=$row["reply_num"]+1;


//检查回答者身份,更新问题state
$resulty=mysqli_query($con, "select * from person where user_id='$people'");
$rowy=mysqli_fetch_array($resulty);
if ($rowy["user_shenfen"]=="assistant" or $rowy["user_shenfen"]=="teacher")
{
	$p_state="已解决";
	mysqli_query($con,"update problem set state='$p_state' where text_content='$problem_text_content'");
}	


mysqli_query($con,"update problem set reply_num=$new_reply_num where text_content='$problem_text_content'");


$time=date("Y/m/d h:i:s");

$pn=0;

//向表中插入数据
$sql="insert into reply(problem_text_content,reply_text_content,file_url,people,time,praise_num)
values('$problem_text_content','$reply_text_content','$file_url','$people','$time','$pn')";


mysqli_query($con, $sql);

header("location:shouye(denglu).php");
mysqli_close($con);
?>

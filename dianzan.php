<?php
$con=mysqli_connect("localhost","root","","users");
if (!$con){
die("连接失败:".mysqli_connect_error());
}
$text=$_GET["content"];

$result=mysqli_query($con, "select * from problem where text_content='$text'");
$row=mysqli_fetch_array($result);
$new_num=$row["praise_num"]+1;

mysqli_query($con,"update problem set praise_num=$new_num where text_content='$text'");

header("location:answer_question.php?content=$text");
mysqli_close($con);
?>
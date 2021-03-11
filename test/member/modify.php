<?php
session_start();
$regist_day = date("Y-m-d (H:i)");
include "../login/dbconn.php";

if(!$_GET['passwd']){
  echo("<script>window.alert('비밀번호를 입력 하세요.'); history.go(-1);</script>"); exit; }

if($_GET['passwd']!=$_GET['pass_confirm']) {
  echo("<script>window.alert('비밀번호를 확인하세요.');history.go(-1);</script>");exit;}

$sql = "select * from member where id='".$_SESSION['userid']."'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$db_pass = $row[pass];

if($_GET['passwd_old']!=$db_pass){
  echo("<script>window.alert('이전 비밀번호가 틀렸습니다.');history.go(-1);</script>");exit;mysql_close();}

$sql="update member set pass='".$_GET['passwd']."', name='".$_GET['name']."', nick='".$_GET['nick']."', mphone='".$_GET['hp']."', email='".$_GET['e-mail']."', regist_day='$regist_day' where id='".$_SESSION['userid']."'";
mysqli_query($connect, $sql);
mysqli_close();
echo "<script>alert('수정 완료');window.alert('다시 로그온하세요.');location.href='../login/logout.php';</script>";
?>













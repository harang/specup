<?php
include "../login/dbconn.php";

if(!$_GET['id']||!$_GET['passwd']){
  echo("<script>window.alert('아이디와 패스워드 모두 입력해야 합니다.');
    history.go(-1);</script>");exit;}
if($_GET['passwd']!=$_GET['pass_confirm']){
  echo("<script>window.alert('비밀번호를 확인하세요.');history.go(-1);</script>");exit;}


$regist_day = date("Y-m-d (H:i)");

$sql = "select id from member where id='".$_GET['id']."'";
$result = mysqli_query($connect, $sql);
$exist_id = mysqli_num_rows($result);

if($exist_id){
    echo("<script>window.alert('해당 아이디가 존재합니다.');history.go(-1);</script>");exit;
}
if( $_GET['chk_info']=="company"){
  $sql="insert into company (id,pass,name,nick,mphone,email,regist_day) ";
  $sql.="values ('".$_GET['id']."','".$_GET['passwd']."','".$_GET['name']."','".$_GET['nick']."','".$_GET['hp']."','".$_GET['e-mail']."','$regist_day')";
  mysqli_query($connect, $sql);
}else if( $_GET['chk_info']=="member"){
  $sql="insert into member (id,pass,name,nick,mphone,email,regist_day) ";
  $sql.="values ('".$_GET['id']."','".$_GET['passwd']."','".$_GET['name']."','".$_GET['nick']."','".$_GET['hp']."','".$_GET['e-mail']."','$regist_day')";
  mysqli_query($connect, $sql);
}


mysqli_close();

echo "<script>window.alert('가입 완료');
	location.href='../index.php';
	</script>";
?>












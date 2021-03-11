<?php 
session_start();


if( ! $_POST['subject'])
{
	echo ("
				<script>
				alert('제목을 입력하세요')
				history.go(-1)
				</script>
				");
	exit;
}
if( ! $_POST['content'])
{
	echo ("
				<script>
				alert('내용을 입력하세요')
				history.go(-1)
				</script>
				");
	exit;
}

if(! $_SESSION['userid']) {
	echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
	exit;
}

	$regist_day = date("Y-m-d (H:i)");
	include "../login/dbconn.php";
	
	$mode = $_GET['mode'];
	$page = $_GET[page];
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	$item_num = $_GET[num];

	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$usernick = $_SESSION['usernick'];
	
	if(is_uploaded_file($_FILES['upfile']['tmp_name']))
	{
		$destination = "../data/" . $_FILES['upfile']['name'];
		move_uploaded_file($_FILES['upfile']['tmp_name'], $destination);
		$file_name = $_FILES['upfile']['name'];
	}

	if($mode == "modify")
	{
		$sql = "update greet set subject='$subject', content='$content', file_name='$file_name' where num=$item_num";

	}
	else {
		$sql = "insert into greet (id, nick, subject, content, regist_day, hit, file_name)";
		$sql .= "values ('$userid', '$usernick', '$subject', '$content', '$regist_day','0','$file_name')";
	}
	
	mysqli_query($connect, $sql);
	mysqli_close();

	echo ("
			<script>
			location.href='list.php?page=$page';
			</script>
			");
?>

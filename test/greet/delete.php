<?php
	//session_start();
	$num = $_GET[num];
	include "../login/dbconn.php";
	
	$sql = "select * from greet where num = $num";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	
	if($row['file_name'])
	{
		unlink("../data/".$row['file_name']);
	}
	
	$sql = "delete from greet where num = $num";
	mysqli_query($connect, $sql);
	
	mysqli_close();
	
	echo ("<script>
			alert('삭제 완료');
			location.href='list.php';
		</script>
	");
?>

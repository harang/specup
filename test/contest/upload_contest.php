<?
session_start();
//$tit = $_GET['number'];
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>공모전 신청 페이지</title>
</head>
<body>
	<form action="dywriteload.php" enctype="multipart/form-data" name="form" method="post" onsubmit="return fileCheck();">
		<h2>공모전 신청하기</h2>
		<table>
		<tr>
			<td>아이디:</td>
			<td><input type="text" name="userid" size="35" maxlength="30" value=<?echo $_SESSION['userid'];?> ></td>
		</tr>
		<tr>
			<td>제목:</td>
			<td><input type="text" name="title" size="35" maxlength="30"></td>
		</tr>
		<tr>
			<td>내용:</td>
			<td><textarea rows="10" cols="37"  name="content"></textarea></td>

		</table>
		 <input type="file" name="fileupload" id="fileupload">
		 <input type="submit" value="신청하기">
		 <input type="button" value ="목록" onclick="location.href='../dynamoDBtest/scan.php'">
	</form>
</body>
</html>
<!-- 파일이 선택되었는지 확인후 첨부되었으면 파일 전송-->
<script type="text/javascript">
	function fileCheck(){
		//html 태그중 file 태그에 값을 확인하여 파일이 있는지 없는지 확인하여 서버 전송 할지 하지 않을지 판단.
		var fileCheck = document.getElementById("fileupload").value;
		if(!fileCheck){
			alert("파일을 첨부해 주세요");
		return false;
		}else {
			return true;
		}
	}
</script>


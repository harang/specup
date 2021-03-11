<html>
<head>
	<!-- 한글 깨짐 발생시 인코딩 euc-kr 또는 utf-8로 설정 -->
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
</head>
<title>파일업로드/파일다운로드 페이지</title>
<body>
	<!-- 파일 첨부후 전송전 파일 첨부되었는지 확인하기 위해 fileCheck 스크립트 사용  -->
	<form action="fileUpload.php" method="post" enctype="multipart/form-data" onsubmit="return fileCheck();">
		<input type="file" name="test_file" id="test_file">
		<input type="submit" value="파일 업로드">
	</form>
</body>
</html>

<!-- 파일이 선택되었는지 확인후 첨부되었으면 파일 전송-->
<script type="text/javascript">
	function fileCheck(){
		//html 태그중 file 태그에 값을 확인하여 파일이 있는지 없는지 확인하여 서버 전송 할지 하지 않을지 판단.
		var fileCheck = document.getElementById("test_file").value;
		if(!fileCheck){
			alert("파일을 첨부해 주세요");
		return false;
		}else {
			return true;
		}
	}
</script>
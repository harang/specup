<?php
header("Content-type: text/html; charset=utf-8");
$myfile_save_dir = "upload/";

//PHP 함수의 $_FILES 함수에서 지원하는 name, type, size, tmp_name, error 활용해 원하는 형태로 코딩 가능.
if (isset($_FILES)) {
    $name = $_FILES["test_file"]["name"];
    $type = $_FILES["test_file"]["type"];
    $size = $_FILES["test_file"]["size"];
	$tmp_name = $_FILES["test_file"]["tmp_name"];
	$error = $_FILES["test_file"]["error"];

	//서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
	$upload_result = move_uploaded_file($tmp_name, $myfile_save_dir . $name);

	if($upload_result){
		$result = "파일 업로드 성공 경로 - " . $myfile_save_dir;
	}

}else{
	echo("첨부된 파일이 없습니다. 다시 시도해 주세요.");
}

echo("파일 이름 - " . $name . "<br>");
echo("파일 타입 - " . $type . "<br>");
echo("파일 크기 - " . $size . "<br>");
echo("파일이 임시로 저장된 위치 - " . $tmp_name . "<br>");
echo("현재 파일의 에러 코드 - " . $error . "<br>"); //에러코드 0인 경우 문제 없음으로 판단.
echo($result."<br>");
?>

<html>
<head></head>
<body>
	<p><a href="http://enjoyrank.com/fileDownload.php?filepath=<?= $myfile_save_dir . $name ?>">업로드한 파일 다운로드 하기</a></p>
	<p><a href="http://enjoyrank.com/file.php">파일 업로드 페이지로 돌아가기</a></p>
</body>
</html>

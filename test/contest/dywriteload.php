<?

include "../header.php";
/**
 * Copyright 2010-2019 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * This file is licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License. A copy of
 * the License is located at
 *
 * http://aws.amazon.com/apache2.0/
 *
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
*/

require '/var/www/html/vendor/autoload.php';

date_default_timezone_set('UTC');

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    'region'   => 'ap-northeast-2',
    'version'  => 'latest'
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tableName = 'contest';

$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$filename = $_FILES["fileupload"]["name"];

$item = $marshaler->marshalJson('
    {
        "userid": "' . $userid . '",
        "title": "' . $title . '",
	"content": "' .$content. '",
	"filename": "' .$filename. '"
    }
');

$params = [
    'TableName' => 'contest',
    'Item' => $item
];


try {
    $result = $dynamodb->putItem($params);

} catch (DynamoDbException $e) {
    echo "Unable to add item:\n";
    echo $e->getMessage() . "\n";
}

?>
<?
$myfile_save_dir = '/var/www/html/test/contest/upload/';

if (isset($_FILES)) {
    $name = $_FILES["fileupload"]["name"];
    $type = $_FILES["fileupload"]["type"];
    $size = $_FILES["fileupload"]["size"];
	$tmp_name = $_FILES["fileupload"]["tmp_name"];
	$error = $_FILES["fileupload"]["error"];

	//서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
	$upload_result = move_uploaded_file($tmp_name, $myfile_save_dir.$name);

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
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>게시물 작성 예제 폼</title>
</head>
<body>
<h2>전송이 완료되었습니다!</h2>
<h3>전송 내용보기</h3>
<table>
<tr>
        <td>아이디:</td>
        <td><?=$userid;?></td>
</tr>
<tr>
        <td>전송제목:</td>
        <td><?=$title;?></td>
</tr>
<tr>
        <td>전송내용:</td>
        <td><?=$content;?></td>
</tr>
<tr>
        <td>파일명:</td>
        <td><?=$path.$filename;?></td>
</tr>
</table>
<p><b>전송완료!</b></p>
<p><a href='../dynamoDBtest/scan.php'>목록가기</a></p>
</body>
</html>

<?
include "../footer.php";
?>

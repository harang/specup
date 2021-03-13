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

// dynamodb 
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$sdk = new Aws\Sdk([
    'region'   => 'ap-northeast-2',
    'version'  => 'latest'
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tableName = 'entryform';

$number = $_POST['idx'];
$title = $_POST['title'];
$userid = $_POST['userid'];
$belong = $_POST['belong'];
$username = $_POST['username'];
$content = $_POST['content'];
$filename = $_FILES["fileupload"]["name"];

// dynamodb 연동 완료
$item = $marshaler->marshalJson('
    {
        "number": ' . $number . ',
        "title": "' . $title . '",
	"info": {
            "소속": "'.$belong.'",
	    "이름": "'.$username.'",
 	    "id": "'.$userid.'",
	    "내용": "'.$content.'",
	    "파일이름": "'.$filename.'"
	}
    }
');

$params = [
    'TableName' => 'entryform',
    'Item' => $item
];


try {
    $result = $dynamodb->putItem($params);

} catch (DynamoDbException $e) {
    echo "Unable to add item:\n";
    echo $e->getMessage() . "\n";
}

// 파일 업로드 코드
$myfile_save_dir = '/var/www/html/test/contest/upload/';

// isset 변수가 설정되었는지 확인해주는함수
if (isset($_FILES)) {
    	$name = $_FILES["fileupload"]["name"];
    	//$type = $_FILES["fileupload"]["type"];
    	//$size = $_FILES["fileupload"]["size"];
        $tmp_name = $_FILES["fileupload"]["tmp_name"];
        //$error = $_FILES["fileupload"]["error"];

        //서버에 임시로 저장된 파일은 스크립트가 종료되면 사라지므로 파일을 이동해야함.
        $upload_result = move_uploaded_file($tmp_name, $myfile_save_dir.$name);

        if($upload_result){
                $result = "파일 업로드 성공 경로 - " . $myfile_save_dir;
        }

        }else{
                echo("첨부된 파일이 없습니다. 다시 시도해 주세요.");
        }
//s3업로드

$s3Client = S3Client::factory(array(
'region' => 'ap-northeast-2',
'version' => 'latest',
'signature' => 'v4',
'key'    => 'AKIA5QVGWJCRHM4LLROL',
'secret' => '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'
));

//$file_handler = fopen('/var/www/html/test/contest/list.php', 'r');

try{
        $result = $s3Client->putObject(array(
        'Bucket' => 'project-contest-apply', // s3버킷 명
        'Key'    => $name,  // 파일명 설정
        'Body'   => $myfile_save_dir.$name, // 경로 설정
        'ACL'    => 'public-read'
        ));

        // Print the URL to the object.
        // echo $result['ObjectURL'] . PHP_EOL;
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
?>

<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>게시물 작성 예제 폼</title>
</head>
<body>
<h2>전송이 완료되었습니다!</h2>
<table>
<tr>
        <td>이름:</td>
        <td><?=$username;?></td>
</tr>
<tr>
        <td>제목:</td>
        <td><?=$title;?></td>
</tr>
<tr>
        <td>내용:</td>
        <td><?=$content;?></td>
</tr>
<tr>
        <td>파일명:</td>
        <td><?=$path.$filename;?></td>
</tr>
</table>
<p><b>전송완료!</b></p>
<p><a href='../dynamoDBtest/scan.php'>목록가기</a></p>
<p><a href="http://52.79.240.252/contest/fileDownload.php?filepath=<?= $myfile_save_dir . $name ?>">업로드한 파일 다운로드 하기</a></p>
</body>
</html>

<?
include "../footer.php";
?>

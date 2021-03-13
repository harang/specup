<?
session_start();


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
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$sdk = new Aws\Sdk([
    'region'   => 'ap-northeast-2',
    'version'  => 'latest'
]);

$myfile_save_dir = '/var/www/html/test/contest/upload/';

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tableName = 'entryform';

$number = $_GET['idx'];
$title = $_GET['title'];

$key = $marshaler->marshalJson('
    {
	"number": '. $number .',
	"title": "' . $title . '"
    }
');

$params = [
    'TableName' => $tableName,
    'Key' => $key
];

try {
    $result = $dynamodb->getItem($params);
     //print_r($result["Item"]);
     $number = $result["Item"]["number"]["N"];
     $title = $result["Item"]["title"]["S"];
     $id = $result["Item"]["info"]["M"]["id"]["S"];
     $con = $result["Item"]["info"]["M"]["내용"]["S"];
     $belong = $result["Item"]["info"]["M"]["소속"]["S"];
     $name = $result["Item"]["info"]["M"]["이름"]["S"];
     $file = $result["Item"]["info"]["M"]["파일이름"]["S"];

?>
<?
// s3 get ( 다운로드)
$s3Client = S3Client::factory(array(
'region' => 'ap-northeast-2',
'version' => 'latest',
'signature' => 'v4',
'key'    => 'AKIA5QVGWJCRHM4LLROL',
'secret' => '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'
));

try{
        $result = $s3Client->getObject(array(
        'Bucket' => 'project-contest-apply', // s3버킷 명
        'Key'    => $name  // 파일명 설정
        ));

} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>게시물 보기</title>
</head>
<body>
<h2>지원서</h2>
<table>
<tr>
        <td>제목: </td>
        <td><?=$title;?></td>
</tr>
<tr>
        <td>아이디: </td>
        <td><?=$id;?></td>
</tr>
<tr>
        <td>이름: </td>
        <td><?=$name;?></td>
</tr>
<tr>
        <td>소속: </td>
        <td><?=$belong;?></td>
</tr>
<tr>
        <td>내용: </td>
        <td><?=$con;?></td>
</tr>
<tr>
        <td>업로드파일: </td>
        <td><?=$file;?></td>
        </td>
</tr>
</table>
<button type="button" onclick="location.href='../dynamoDBtest/scan.php'" class="btn btn-theme" >목록</a>

</body>
</html>


<?
} catch (DynamoDbException $e) {
    echo "Unable to get item:\n";
    echo $e->getMessage() . "\n";
} 
?>


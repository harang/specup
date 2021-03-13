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
	"userid": '. $number .',
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
     echo $number = $result["Item"]["number"]["N"];
     echo $tit = $result["Item"]["title"]["S"];
     echo $con = $result["Item"]["content"]["S"];
     echo $file =  $result["Item"]["filename"]["S"];
    
     echo $result["Item"]["filename"]["S"];


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
        <td>아이디: </td>
        <td><?=$id;?></td>
</tr>
<tr>
        <td>제목: </td>
        <td><?=$tit;?></td>
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
<p><a href='list.php'>목록가기</a></p>
<p><a href="http://52.79.240.252/contest/fileDownload.php?filepath=<?= $myfile_save_dir . $file ?>">업로드
한 파일 다운로드 하기</a></p>

</body>
</html>


<?
} catch (DynamoDbException $e) {
    echo "Unable to get item:\n";
    echo $e->getMessage() . "\n";
} 
?>


<?
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

$userid = $_GET['idx'];
$title = $_GET['title'];

$key = $marshaler->marshalJson('
    {
	"userid": "'. $userid .'",
	"title": "' . $title . '"
    }
');

$params = [
    'TableName' => $tableName,
    'Key' => $key
];

try {
    $result = $dynamodb->getItem($params);
   // print_r($result["Item"]);

} catch (DynamoDbException $e) {
    echo "Unable to get item:\n";
    echo $e->getMessage() . "\n";
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
        <td>아이디: </td>
        <td><?=$userid;?></td>
</tr>
<tr>
        <td>제목: </td>
        <td><?=$title;?></td>
</tr>
<tr>
        <td>내용: </td>
        <td><?=$content;?></td>
</tr>
<tr>
        <td>이미지: </td>
        <td>
<?
if(!empty($row2))
        echo "<img src='".$row2['path'].$row2['filename']."' />";
else
        echo "이미지 없음";
?>
        </td>
</tr>
</table>
<p><b>확인</b></p>
<p><a href='list.php'>목록가기</a></p>
</body>
</html>

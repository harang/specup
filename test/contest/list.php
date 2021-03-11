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

$number = $_GET['idx'];
$tableName = 'Entryform'

$eav = $marshaler->marshalJson('
    {
        ":num": 7
    }
');

$params = [
    'TableName' => $tableName,
    'KeyConditionExpression' => '#num = :num',
    'ExpressionAttributeNames'=> [ '#num' => 'number' ],
    'ExpressionAttributeValues'=> $eav
];

$date = date("Y-m-d");
?>

<article>
<div class="container">
  <center>
  <h1> 공모전 참여현황 </h1>
  </center><hr>
  <table>
  <tr>
    <th></th>
    <th>ID</th>
    <th>제목</th>
    <th>내용</th>
    <th>작성일</th>
<?
try {
    while (true) {
        $result = $dynamodb->scan($params);

        foreach ($result['Items'] as $i) {
            $contest = $marshaler->unmarshalItem($i);
?> 


    <tr>	   
	<td><input type='checkbox' name='select' value='<?$contest['userid'] ?>'/></td>   
	<td><?= $contest['userid'] ?></td>	
	<td><a href='view.php?idx=<?echo $contest['userid'];?>&title=<?= $contest['title'];?>'><?= $contest['title'] ?></a> </td>
	<td><?= $contest['content'] ?></td>
	<td><?= $date ?></td>



<?
        }

        if (isset($result['LastEvaluatedKey'])) {
            $params['ExclusiveStartKey'] = $result['LastEvaluatedKey'];
        } else {
            break;
        }
    }

} catch (DynamoDbException $e) {
    echo "Unable to scan:\n";
    echo $e->getMessage() . "\n";
}
?>
</table>
</div>
</article>
<?
include "../footer.php";
?>

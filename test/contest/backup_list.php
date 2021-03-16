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
$tableName = 'entryform';
$num = $_GET['idx'];

$eav = $marshaler->marshalJson('
    {
        ":titnum": '.$num.'
    }
');

$params = [
    'TableName' => $tableName,
    'KeyConditionExpression' => '#num = :titnum',
    'ExpressionAttributeNames'=> [ '#num' => 'number' ],
    'ExpressionAttributeValues'=> $eav
];


?>

<article>
<div class="container">
  <center>
  <h1> 공모전 참여현황 </h1>
  </center><hr>
  <table>
  <tr>
    <th></th>
    <th>이름</th>
    <th>소속</th>
    <th>제목</th> 
    <th>날짜</th> 
 </tr>


<?
$dataString =date("Y-m-d");
try {
	$result = $dynamodb->query($params);
		
        foreach ($result['Items'] as $i) {
	// echo $marshaler->unmarshalValue($entry['number']) . ': ' .
 	  //    $marshaler->unmarshalValue($entry['title']) . "\n";
	$entry = $marshaler->unmarshalItem($i);
?>

    <tr>
	<!--<td><input type='checkbox' name='select' value='<?$entryform['number'] ?>'/></td>
	<td><a href='view.php?idx=<?echo $num;?>'><?= $entryform['title']?></a></td>
    -->
    <td><input type='checkbox' name='select' value='<?$Board['number'] ?>'/> </td>
    <td><?echo $entry['info']['이름']?> </td>
    <td><?echo $entry['info']['소속']?></td>
    <td><a href='view.php?idx=<?echo $num;?>&title=<?echo $entry['title'];?>'><?echo $entry['title']?></a></td>
    <td><?echo $dataString?> </td>
    </tr>

<?
    }
} catch (DynamoDbException $e) {
    echo "Unable to scan:\n";
    echo $e->getMessage() . "\n";
}?>

</table>
<hr>
 <input type="button" value ="목록" onclick="location.href='../dynamoDBtest/scan.php'">
</div>
</article>


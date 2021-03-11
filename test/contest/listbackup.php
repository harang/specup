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
        ":nnn": 7
    }
');

$params = [
    'TableName' => $tableName,
    'KeyConditionExpression' => '#nm = :nnn',
    'ExpressionAttributeNames'=> [ '#nm' => 'number' ],
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
    <th>소속</th>
    <th>이름</th>
    <th>신청상태</th>
  </tr>

<?
try {
    while (true) {
        $result = $dynamodb->query($params);

        foreach ($result['Items'] as $i) {
            $contest = $marshaler->unmarshalItem($i);
?> 


    <tr>	   
	<td><input type='checkbox' name='select' value='<?$contest['userid'] ?>'/></td>   
	<td><? $contest['info']['소속'] ?></td>	
	<td><? $contest['info']['이름']?></td>
	<td><? $contest['info']['신청상태']?></td>
    </tr>


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


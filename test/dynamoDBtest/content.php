<?
session_start();
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

$tableName = 'Board';

$number = $_GET['idx'];
$title = $_GET['title'];

$key = $marshaler->marshalJson('
    {
        "number": ' . $number . ', 
        "title": "' . $title . '"
    }
');

$params = [
    'TableName' => $tableName,
    'Key' => $key
];
?>
 <center>
 <h1>공모전  상세 내역 </h1>
 <hr>
 <table>
 </tr>
    <th></th>
    <th>제목</th>
    <th>진행기간</th>
    <th>진행사항</th>
<?
try {
    $result = $dynamodb->getItem($params);
    // print_r($result["Item"]);
     $num = $result["Item"]["number"]["N"];
     $tit = $result["Item"]["title"]["S"];
     $term = $result["Item"]["info"]["M"]["진행기간"]["S"];
     $state = $result["Item"]["info"]["M"]["진행사항"]["L"][0]["S"];
     $add = $result["Item"]["info"]["M"]["content"]["S"];
?>
  <tr>
    <td></td>
    <td><?= $tit?></td>
    <td><?= $term ?></td>
    <td><?= $state ?></td>
  </tr>
    </table>
  <!__  <img src="https://project-contest-detail.s3.ap-northeast-2.amazonaws.com/contest_7.png">    
    <img src="<?= $add;?>">
    <hr>
<?if ($_SESSION['type']== "member"){ ?>
    <input type='button' value='공모전 신청' onClick='location.href="../contest/upload_contest.php?idx=<?echo $number;?>"' />
<?} if($_SESSION['type']=="company" or $_SESSION['userid']=="admin"){
?>
    <input type='button' value='참가현황' onClick='location.href="../contest/list.php?idx=<?echo $num;?> "' />
<?} ?>     
	<input type="button" value ="목록" onclick="location.href='../dynamoDBtest/scan.php'">
  </center>
<?

} catch (DynamoDbException $e) {
    echo "Unable to get item:\n";
    echo $e->getMessage() . "\n";
}

?>

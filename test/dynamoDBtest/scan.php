<?php

include "../header.php";
include "../login/dbconn.php";
?>

<html>
	<head>
	<link href="/basic/css/main.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
	<link href="css/jcarousel.css" rel="stylesheet" />
	<link href="css/flexslider.css" rel="stylesheet" />
	<link href="js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" />
	</head>




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

//Expression attribute values
$eav = $marshaler->marshalJson('
    {
        ":start_num": 1,
        ":end_num": 100
    }
');

$params = [
    'TableName' => 'Board',
    'ProjectionExpression' => '#num, title, info.rating',
    'FilterExpression' => '#num between :start_num and :end_num',
    'ExpressionAttributeNames'=> [ '#num' => 'number' ],
    'ExpressionAttributeValues'=> $eav
];

?>

<article>
<div class="container">
  <h1> 공모전 목록 </h1>
  <a href='upload_form.php' class="btn btn-theme" >글쓰기</a>
  <table>
  <tr>
    <th></th>
    <th>제목</th>

<?php
try {
    while (true) {
        $result = $dynamodb->scan($params);

        foreach ($result['Items'] as $i) {
            $Board = $marshaler->unmarshalItem($i);
        
?>
  <tr>
    <td><input type='checkbox' name='select' value='<?$Board['number'] ?>'/></td>
    <?//= $Board['number'] ?>
    <td><a href='content.php?idx=<?echo $Board['number'];?>&title=<?echo $Board['title'];?>'><?= $Board['title'] ?></a> </td>
    <td><?= $Board['info']['진행기간'] ?></td></tr>


<?php
	}
?>


<?php



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

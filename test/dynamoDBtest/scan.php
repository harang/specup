<?php

include "../header.php";
include "../login/dbconn.php";

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
        ":start_yr": 1920,
        ":end_yr": 1925
    }
');

$params = [
    'TableName' => 'MoviesTest1',
    'ProjectionExpression' => '#yr, title, info.rating',
    'FilterExpression' => '#yr between :start_yr and :end_yr',
    'ExpressionAttributeNames'=> [ '#yr' => 'year' ],
    'ExpressionAttributeValues'=> $eav
];

?>

<article>
<div class="container">
  <h1> Notice </h1>
  <a href='upload_form.php' class="btn btn-theme" >글쓰기</a>
  <table>
  <tr>
    <th></th>
    <th>Year</th>
    <th>Title</th>
    <th>Rating</th></tr>



<?php
try {
    while (true) {
        $result = $dynamodb->scan($params);

        foreach ($result['Items'] as $i) {
            $movie = $marshaler->unmarshalItem($i);
        
?>
  <tr>
    <td><input type='checkbox' name='select' value='<?$movie['year'] ?>'/></td>
    <td><?= $movie['year'] ?></td>
    <td><a href='content.php?idx=<?echo $movie['year'];?>&title=<?echo $movie['title'];?>'><?= $movie['title'] ?></a> </td>
    <td><?= $movie['info']['rating'] ?></td></tr>


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

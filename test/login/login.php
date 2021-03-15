<?php


require '/var/www/html/vendor/autoload.php';
use Aws\DynamoDb\DynamoDbClient;

$client = new DynamoDbClient([
   'region' => 'ap-northeast-2',
   'version' => 'latest'
]);

$table = 'usersession';


session_start();

if(! $_GET['userid'] ){
    echo("<script>window.alert('아이디를 입력하세요.');
             history.go(-1);</script>");exit;}

include "dbconn.php";

if( $_GET['chk_info']=="member"){
	$sql = "select * from member where id='".$_GET['userid']."' and pass='".$_GET['passwd']."'";
}else if( $_GET['chk_info']=="company"){
	$sql = "select * from company where id='".$_GET['userid']."' and pass='".$_GET['passwd']."'";
}
$result = mysqli_query($connect, $sql);
$num_match = mysqli_num_rows($result);

if(! $num_match){
    echo("<script>window.alert('입력 정보가 틀렸습니다.');
             history.go(-1);</script>");
}else{
    $row = mysqli_fetch_array($result);
    mysqli_close();
    $_SESSION['userid'] = $row[id];
    $_SESSION['username'] = $row[name];
    $_SESSION['usernick'] = $row[nick];
    $_SESSION['hp'] = $row[mphone];
    $_SESSION['e-mail'] = $row[email];
    $_SESSION['regist_day'] = $row[regist_day];
    if($_GET['chk_info']=="member"){
	    $_SESSION['type'] = "member";
    }else{
	    $_SESSION['type'] = "company";	
    }
    echo("<script>window.alert('로그인 성공');
           location.href = '../index.php';</script>");

$sessionId = session_id();

$result = $client->putItem([
    'Item' => [
        'id' => [
            'S' => $sessionId,
        ],
    ],
    'ReturnConsumedCapacity' => 'TOTAL',
    'TableName' => 'usersession',
]);

}
?>

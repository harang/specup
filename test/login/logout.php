<?

require '/var/www/html/vendor/autoload.php';
use Aws\DynamoDb\DynamoDbClient;

$client = new DynamoDbClient([
   'region' => 'ap-northeast-2',
   'version' => 'latest'
]);

$table = 'usersession';

  session_start();
  unset($_SESSION['userid']);
  unset($_SESSION['username']);
  unset($_SESSION['usernick']);
  unset($_SESSION['hp']);
  unset($_SESSION['e-mail']);
  unset($_SESSION['regist_day']);

  $sessionId = session_id();

$result = $client->deleteItem([
    'Key' => [
        'id' => [
            'S' => $sessionId,
        ],
    ],
    'TableName' => 'usersession',
]);


  echo("<script>window.alert('다음에 또 만나요!');
	location.href='../index.php';</script>");
?>

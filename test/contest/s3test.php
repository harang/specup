<?
require '/var/www/html/vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$s3Client = S3Client::factory(array(
'region' => 'ap-northeast-2',
'version' => 'latest',
'signature' => 'v4',
'key'    => 'AKIA5QVGWJCRHM4LLROL',
'secret' => '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'
));

$file_handler = fopen('/var/www/html/test/contest/list.php', 'r');

try{
	$result = $s3Client->putObject(array(
	'Bucket' => 'project-contest-apply',
	'Key'    => 'list.php',
	'Body'   => $file_handler,
	'ACL'    => 'public-read'
	));

	// Print the URL to the object.
    	echo $result['ObjectURL'] . PHP_EOL;
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>

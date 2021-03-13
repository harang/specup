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

$test = 'ready1.png';

try{
	$result = $s3Client->getObject(array(
	'Bucket' => 'project-contest-apply',
	'Key'    => 'ready.jpg',
	'SaveAs' => fopen($test, 'w')
	));

	// Print the URL to the object.
    	echo "성공"; 
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>

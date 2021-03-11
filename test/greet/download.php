<?php
$file = $_GET['file'];
$length = filesize("../data/".$file);
Header("Content-Type: application/octet-stream");
Header("Content-Disposition: attachment; filename=".$file);
Header("Content-Transfer-Encoding: binary");
Header("Content-Length: ".$length);
Header("Cache-Control: cache, must-revalidate");
Header("Pragma: no-cache");
Header("Expires: 0");

$fp = fopen("../data/".$file, "rb");
while(!feof($fp))
{
	echo fread($fp, $length);
	flush();
}
fclose($fp);
?>
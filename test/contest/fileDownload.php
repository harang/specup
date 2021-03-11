<?php
	$getpath = $_GET["filepath"];
	$filepath = $_SERVER['/var/www/html/test/contest/upload'] . "/" . $getpath;
	
	$filesize = filesize($filepath);
	$path_parts = pathinfo($filepath);
	$filename = $path_parts['basename'];
	$extension = $path_parts['extension'];

	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: $filesize");

	ob_clean();
	flush();
	readfile($filepath);
?>

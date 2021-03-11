<?php
$mysql_hostname = 'project-db-test-instance.cec0r68fu0ee.ap-northeast-2.rds.amazonaws.com';
$mysql_username = 'testuser';
$mysql_password = '123456789';
$mysql_database = 'projectdb';

$connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
	
mysqli_select_db($connect, $mysql_database) or die('DB connection ERROR');
?>

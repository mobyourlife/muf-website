<?php
require_once 'library/facebook.php';

$app_id = "{app_id}";
$app_secret = "{app_secret}";

$admin_fbid = "{user_id}";

$mysql_hostname = "{mysql_hostname}";
$mysql_database = "{mysql_database}";
$mysql_username = "{mysql_username}";
$mysql_password = "{mysql_password}";

$facebook = new Facebook(array(
	'appId' => $app_id,
	'secret' => $app_secret,
	'cookie' => true
));

?>
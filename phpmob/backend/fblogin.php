<?php
require_once "config.php";

if (!$_GET['state'])
{
	header("Location: ../");
}

if (strcmp($_GET['state'], $_SESSION['XSRF_TOKEN']) != 0)
{
	header("Location: ../");
}

if ($_GET['code'])
{
	$params = array();
	$params["client_id"] = $app_id;
	$params["redirect_uri"] = sprintf("%s://%s/%s/backend/fblogin", $website_proto, $website_host, $website_root);
	$params["client_secret"] = $app_secret;
	$params["code"] = $_GET['code'];
	
	$redirect = MakeLocation("https://graph.facebook.com/oauth/access_token", $params);
	header($redirect);
}
else if ($_GET['access_token'])
{
	var_dump($_GET);
}
else
{
	header("Location: ../");
}

?>

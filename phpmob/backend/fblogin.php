<?php
require_once "config.php";

/* Verifica o retorno do token anti XSRF. */
if ($_GET['state'])
{
	/* Compara o token anti XSRF. */
	if (strcmp($_GET['state'], $_SESSION['XSRF_TOKEN']) != 0)
	{
		header("Location: ../");
	}
}

if ($_GET['code'])
{
	/* Prepara a chamada para obter o User Token. */
	$params = array();
	$params["client_id"] = $app_id;
	$params["redirect_uri"] = sprintf("%s://%s/%s/backend/fblogin", $website_proto, $website_host, $website_root);
	$params["client_secret"] = $app_secret;
	$params["code"] = $_GET['code'];
	
	$res = GetCurl("https://graph.facebook.com/oauth/access_token", $params);
	var_dump($res);
}
else if ($_GET['access_token'])
{
	/* APP TOKEN:
	https://graph.facebook.com/oauth/access_token?client_id=671519346228438&client_secret=eb5ad176974e393cdbe81fc0a24700bd&grant_type=client_credentials
	*/
	var_dump($_GET);
	
	/* Prepara a chamada para obter o App Token. */
	/*
	$params = array();
	$params["client_id"] = $app_id;
	$params["client_secret"] = $app_secret;
	$params["grant_type"] = "client_credentials";
	$url = MakeURL("https://graph.facebook.com/oauth/access_token", $params);
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	curl_close($ch);
	
	die($res);
	*/
}
else
{
	header("Location: ../");
}
*/

?>

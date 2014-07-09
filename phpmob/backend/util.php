<?php
session_start();

/* Cria um token anti XSRF caso ainda não exista */
if (!$_SESSION['XSRF_TOKEN'])
{
	$_SESSION['XSRF_TOKEN'] = base64_encode(openssl_random_pseudo_bytes(32));
}

/* Tratamento de URLs para chamadas de API. */
function MakeURL($fbmethod, $fbparams)
{
	$handle = array();
	foreach($fbparams as $key => $value)
	{
		$handle[] = sprintf("%s=%s", $key, $value);
	}
	
	$url = sprintf("%s?%s", $fbmethod, join("&", $handle));
	return $url;
}

/* Tratamento de redirecionamento para chamadas de API. */
function MakeLocation($fbmethod, $fbparams)
{
	$url = MakeURL($fbmethod, $fbparams);
	$loc = sprintf("Location: %s", $url);
	return $loc;
}

/* Retorno de chamada direta de API. */
function GetCurl($fbmethod, $fbparams)
{
	global $website_proto, $website_host, $website_root;
	$cur = sprintf("%s://%s/%s/backend/fblogin", $website_proto, $website_host, $website_root);
	$url = MakeURL($fbmethod, $fbparams);
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_REFERER, $cur);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}

?>

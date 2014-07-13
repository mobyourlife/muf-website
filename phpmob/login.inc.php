<?php
require_once "Facebook/FacebookSession.php";
require_once "Facebook/FacebookRedirectLoginHelper.php";
require_once "Facebook/FacebookRequest.php";
require_once "Facebook/FacebookResponse.php";
require_once "Facebook/FacebookSDKException.php";
require_once "Facebook/FacebookRequestException.php";
require_once "Facebook/FacebookAuthorizationException.php";
require_once "Facebook/Entities/AccessToken.php";
require_once "Facebook/HttpClients/FacebookCurl.php";
require_once "Facebook/HttpClients/FacebookHttpable.php";
require_once "Facebook/HttpClients/FacebookCurlHttpClient.php";
require_once "Facebook/GraphObject.php";

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

/* Inicializa o aplicativo com seu ID e segredo. */
FacebookSession::setDefaultApplication($app_id, $app_secret);

/* Verifica se o login já está armazenado. */
if (isset($_SESSION['FB_LOGIN']))
{
	try
	{
		$fb_session = unserialize($_SESSION['FB_LOGIN']);
	}
	catch (Exception $ex)
	{
		unset($fb_session);
		unset($_SESSION['FB_LOGIN']);
	}
}

/* Inicializa o login helper com a URL de redirecionamento. */
if (!isset($fb_session))
{
	$redirect = sprintf("%s://%s/%s/login", $website_proto, $website_host, $website_root);
	$redirect = str_replace("//", "//", $redirect);
	$helper = new FacebookRedirectLoginHelper($redirect);
	
	try
	{
		$fb_redirected = true;
		$fb_session = $helper->getSessionFromRedirect();
		$_SESSION['FB_LOGIN'] = serialize($fb_session);
	}
	catch( FacebookRequestException $ex )
	{
		/* TODO: tratar erros do Facebook */
	}
	catch( Exception $ex )
	{
		/* TODO: tratar outros tipos de erro */
	}
}

/* Verifica se a sessão foi criada. */
if (isset($fb_session))
{
	/* Solicita os dados do usuário logado. */
	$request = new FacebookRequest($fb_session, 'GET', '/me');
	$response = $request->execute();
	$fb_profile = $response->getGraphObject();
	
	if (isset($fb_redirected))
	{
		header("Location: ./registrar");
	}
}
else
{
	$fb_loginurl = $helper->getLoginUrl();
}

?>
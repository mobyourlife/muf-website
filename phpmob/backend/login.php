<?php
require_once "backend/config.php";

session_start();

require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once('Facebook/GraphObject.php');

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
		$session = unserialize($_SESSION['FB_LOGIN']);
	}
	catch (Exception $ex)
	{
		unset($session);
		unset($_SESSION['FB_LOGIN']);
	}
}

/* Inicializa o login helper com a URL de redirecionamento. */
if (!isset($session))
{
	$redirect = sprintf("%s://%s/%s/login", $website_proto, $website_host, $website_root);
	$helper = new FacebookRedirectLoginHelper($redirect);
	
	try
	{
		$session = $helper->getSessionFromRedirect();
		$_SESSION['FB_LOGIN'] = serialize($session);
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
if (isset($session))
{
	/* Solicita os dados do usuário logado. */
	$request = new FacebookRequest($session, 'GET', '/me');
	$response = $request->execute();
	$fb_profile = $response->getGraphObject();
}
else
{
	$loginurl = $helper->getLoginUrl();
}

?>

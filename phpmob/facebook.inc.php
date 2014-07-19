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

/* Remove todos os dados de sessão para fazer logout do Facebook. */
function unsetfb()
{
	unset($fb_session);
	unset($_SESSION['FB_SESSION']);
	unset($_SESSION['FB_PROFILE']);
	unset($_SESSION['FB_JOURNAL']);
	session_destroy();
}

/* Inicializa o aplicativo com seu ID e segredo. */
FacebookSession::setDefaultApplication($app_id, $app_secret);

/* Verifica se o login já está armazenado. */
if (isset($_SESSION['FB_SESSION']))
{
	try
	{
		$fb_session = unserialize($_SESSION['FB_SESSION']);
	}
	catch (Exception $ex)
	{
		unsetfb();
	}
}

/* Inicializa o login helper com a URL de redirecionamento. */
if (!isset($fb_session))
{
	$redirect = sprintf("%s://%s/%s/facebook-login", $website_proto, $website_host, $website_root);
	$redirect = str_replace("://", ":///", $redirect);
	$redirect = str_replace("//", "/", $redirect);
	$helper = new FacebookRedirectLoginHelper($redirect);

	/* Verifica se é o retorno do Facebook. */
	if (isset($_GET['code']))
	{
		try
		{
			$fb_session = $helper->getSessionFromRedirect();
			/*$fb_session = new FacebookSession("CAACEdEose0cBAPFlkfJxmTNoy6tRQU7l3KENGpEb4SfG7hHwRJjUsTWDCxuLRl6ZC9OzwvnFFlLPJYUfMuilWaYZBEXECxzZCqMBeVbap3q1WrqJvTKgvVUeamu8WUXfCXeMFhcUE2xupncYU6lSJGuHK1mwW7eosZCbsBSSwDNSN6ddbQwJkR3wa5VpsnAyGttZA3BcN6QpbjNRo6GWH");*/
			$_SESSION['FB_SESSION'] = serialize($fb_session);
		}
		catch( FacebookRequestException $ex )
		{
			/* TODO: tratar erros do Facebook */
			die($ex);
			unsetfb();
		}
		catch( Exception $ex )
		{
			/* TODO: tratar outros tipos de erro */
			die($ex);
			unsetfb();
		}
	}
}

/* Monta a URL para login. */
if (!isset($fb_session))
{
	$fb_loginurl = $helper->getLoginUrl();
	$fb_panelurl = sprintf("%s://%s/%s/painel", $website_proto, $website_host, $website_root);
	$fb_panelurl = str_replace("://", ":///", $fb_panelurl);
	$fb_panelurl = str_replace("//", "/", $fb_panelurl);
}

/* Solicita os dados do usuário logado. */
function get_profile()
{
	global $fb_session;
	
	if (isset($fb_session))
	{
		$request = new FacebookRequest($fb_session, 'GET', '/me');
		$response = $request->execute();
		$fb_profile = $response->getGraphObject();
		return $fb_profile;
	}
	
	return null;
}

/* Solicita as permissões do uusário em páginas do Facebook. */
function get_accounts()
{
	global $fb_session;
	$request = new FacebookRequest($fb_session, 'GET', '/me/accounts');
	$response = $request->execute();
	$fb_accounts = $response->getGraphObject();
	return $fb_accounts;
}

?>

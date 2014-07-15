<?php
require_once "config.inc.php";
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

function unsetfb()
{
	unset($fb_session);
	unset($_SESSION['FB_LOGIN']);
}

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
			$_SESSION['FB_LOGIN'] = serialize($fb_session);
		}
		catch( FacebookRequestException $ex )
		{
			/* TODO: tratar erros do Facebook */
			unsetfb();
		}
		catch( Exception $ex )
		{
			/* TODO: tratar outros tipos de erro */
			unsetfb();
		}
	}
}

/* Verifica se a sessão foi criada. */
if (isset($fb_session))
{
	/* Solicita os dados do usuário logado. */
	$request = new FacebookRequest($fb_session, 'GET', '/me');
	$response = $request->execute();
	$fb_profile = $response->getGraphObject();
}
/* Monta a URL para login. */
else
{
	$fb_loginurl = $helper->getLoginUrl();
	$fb_panelurl = sprintf("%s://%s/%s/painel", $website_proto, $website_host, $website_root);
	$fb_panelurl = str_replace("://", ":///", $fb_panelurl);
	$fb_panelurl = str_replace("//", "/", $fb_panelurl);
}

?>

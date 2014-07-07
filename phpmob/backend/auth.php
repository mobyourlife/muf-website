<?php
require_once 'config.php';

$user = $facebook->getUser();

$user_profile = array();
$user_profile["id"] = 0;
$user_profile["name"] = null;
$user_profile["link"] = null;

if ($user != null)
{
    try
    {
        $user_profile = $facebook->api('/me?fields=id,name,link');
        $fbid = $user_profile['id'];
    }
    catch (FacebookApiException $ex)
    {
        error_log($ex);
        $user = null;
    }
}

if ($user != null)
{
    $logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://debug.fmoliveira.com.br/muf/backend/logout.php'));
}
else
{
    $loginUrl = $facebook->getLoginUrl(array('scope' => 'email'));
}

?>
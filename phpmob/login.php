<?php
require_once "backend/config.php";

$params = array();
$params["client_id"] = $app_id;
$params["redirect_uri"] = sprintf("%s://%s/%s/backend/fblogin", $website_proto, $website_host, $website_root);
$params["state"] = urlencode($_SESSION['XSRF_TOKEN']);

$redirect = MakeLocation("https://www.facebook.com/dialog/oauth", $params);
header($redirect);

?>

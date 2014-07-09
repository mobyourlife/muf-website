<?php
require_once "backend/config.php";

$redirect = sprintf("Location: https://www.facebook.com/dialog/oauth?client_id=%s&redirect_uri=%s", $app_id, $_SERVER["HTTP_REFERER"]);
header($redirect);

?>

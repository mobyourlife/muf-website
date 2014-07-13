<?php
session_start();

require_once "config.inc.php";
require_once "login.inc.php";

function printlink($resource = "")
{
	global $website_root;
	return printf("%s/%s", $website_root, $resource);
}

?>

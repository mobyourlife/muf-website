<?php
require_once "core.inc.php";
unsetfb();

header("Location: " . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $website_root));
?>

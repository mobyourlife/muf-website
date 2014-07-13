<?php

session_start();

unset($_SESSION['FB_LOGIN']);
header("Location: ./");

?>

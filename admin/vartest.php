<?php
session_start();
require 'includes/mwbe_conf.php';

echo "Server Path Info: " . $_SERVER['PATH_INFO'] . "<br />\n";

$mwbe_dir = preg_replace('/(\/admin)(.+)($)/', "", $_SERVER['PHP_SELF']);
echo "mwbe dir: $mwbe_dir<br />\n";

echo "SESSION VARS
<pre>\n";
print_r($_SESSION);
echo "</pre>\n";
echo "SERVER VARS
<pre>\n";
print_r($_SERVER);
echo "</pre>\n";


?>
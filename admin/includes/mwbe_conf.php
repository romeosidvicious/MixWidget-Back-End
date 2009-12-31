<?php

//Nothing below this line should need editing
$_SESSION['mwbe_dir'] = preg_replace('/(\/admin)(.+)($)/', "", $_SERVER['PHP_SELF']);
$_SESSION['mwbe_server_path'] = $_SERVER["DOCUMENT_ROOT"] . $_SESSION['mwbe_dir'];
$_SESSION['mwbe_base_url'] = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$_SESSION['mwbe_site_url'] = "http://" . $_SERVER["HTTP_HOST"] . $_SESSION['mwbe_dir'];

if (isset($_GET['action'])) {
	$_SESSION['action'] = $_GET['action'];
} elseif (isset($_POST['action'])) {
	$_SESSION['action'] = $_POST['action'];
} else {
	$_SESSION['action'] = "index";
}
$_SESSION['mwbe_writable_dirs'] = array("playlists" => "/playlists/", "confs" => "/confs/", "mixes" => "/mixes/", "tracks" => "/tracks/", "archives" => "/archives/");
$_SESSION['mwbe_cover_img'] = '/cover.jpg';
?>
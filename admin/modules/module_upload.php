<?php
/*
 * This file provides upload functionality for MWBE
 */

function get_file(){
	global $static_conf;
	$_SESSION['mw_mix_title'] = $_POST['mix_title'];
	$_SESSION['mw_mix_title_short'] = strtolower(preg_replace("/\W|\s/", "", $_SESSION['mw_mix_title']));
	$_SESSION['mw_mix_artist'] = $_POST['mix_artist'];
	$_SESSION['mw_skin_img'] = $_POST['skin_img'];
	$_SESSION['mw_mix_allow_archive'] = $_POST['mwbe_archive_allow'];
	$_SESSION['mw_mix_allow_embed'] = $_POST['mwbe_embed_allow'];
	echo "<div id=\"content\">
		<h2>Time to get your music on...</h2>
		<div class=\"selections\">
		Your choices so far:
		The title for your mix will be: " . $_SESSION['mw_mix_title'] . "<br />
		The artist for your mix is: " . $_SESSION['mw_mix_artist'] . "<br />
		Your selected skin image is:<br />
		<img height=\"200\" src= \"" . $static_conf->MWBE['SITE_URL'] . "/" . $static_conf->MWBE['SKINS_DIR'] . "/" . $_SESSION['mw_skin_img'] . "\"><br />
		</div>
	The maximum size file your server will allow to upload is: " . ini_get('upload_max_filesize') . ".<br />
	Attempting to upload a larger file through MixWidget Back End will fail. If you need to upload a larger file please transfer the file to your server via FTP, SCP, or some other method and use the option to enter a path to a file on the server.<br />
	<form enctype=\"multipart/form-data\" action=\"index.php?action=verify\" method=\"POST\">
	Choose a zip file to upload: <input name=\"zipfile\" type=\"file\" />
	<input type=\"submit\" value=\"Upload Zip File\" />
	</form>
	</div>
	<form action=\"index.php?action=verify\" method=\"POST\">
	Enter a path to a zip file on the server: <input name=\"localzipfile\" type=\"text\" />
	<input type=\"submit\" value=\"Submit\" />
	</form>";
}

function archive_up(){
	global $static_conf;

}

function mp3_up(){
	global $static_conf;

}

function cover_up(){
	global $static_conf;

}
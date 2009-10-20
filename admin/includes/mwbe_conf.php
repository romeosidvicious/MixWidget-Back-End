<?php

// User Defined Vars
// Direcotries must include trailing slash
$mwbe_dir = ""; // if you have installed MWBE in the root of a webserver leave blank
$mwbe_server_path = $_SERVER["DOCUMENT_ROOT"] . "/" . $mwbe_dir;
$mwbe_rel_path = "../"; //path relative to your base mixwidget back end relative to the admin directory
//You shouldn't need to change anything under this

//URL Functionality
$action = $_GET["action"];
$mix = $_GET["mix"];


//Files & Directories

// MixWidget Frontend
$mwbe_admin_dir = "admin/";  
$mwbe_playlist_dir = "playlists/";
$mwbe_conf_dir = "confs/";
$mwbe_html_dir = "mixes/";
$mwbe_skins_dir = "skins/";
$mwbe_tracks_dir = "tracks/";
$mwbe_up_dir = "archives/";
$mwbe_mixes_index = "index.php";
$mwbe_mixes = "mixes.php";
$mwbe_cover_img = 'cover.jpg';
$mwbe_base_url = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$mwbe_site_url = "http://" . $_SERVER["HTTP_HOST"] . "/" . $mwbe_dir;
$mw_dir = "mixwidget/";
$mw_resources = "resources/";
$mw_main_swf = $mw_dir . "mixwidget.swf";
$mw_main_ds = $mw_dir . ".DS_Store";
$mw_resources_swf = $mw_resources . "expressInstall.swf";
$mw_resources_js = $mw_resources . "swfobject.js";
$mw_resources_ds = $mw_resources . ".DS_Store";

// MixWidget conf defaults
$mw_mix_title = $_POST['mix_title']; // shows on your MixWidget tape before play is pressed. Can by any text string
// convert the full title to a string we can use to name things

$mw_mix_title_short = str_replace("/[^a-zA-Z0-9s]/", "", $mw_mix_title); // remove any non alpha-numeric characters
$mw_mix_title_short = str_replace(" ", "", $mw_mix_title); //remove any spaces
$mw_mix_title_short = strtolower($mw_mix_title_short); // make it lower case to avoid issues on case sensitive systems
$mw_mix_artist = $_POST['mix_artist']; // show on your MixWidget tape before play is pressed. Can be any text string
// end title conversion
$mw_mix_tracks_dir = $mwbe_tracks_dir . $mw_mix_title_short . "/";
$mw_mix_archive = $mwbe_up_dir . $mw_mix_title_short . ".zip";
$mw_mix_playlist = $mwbe_playlist_dir . $mw_mix_title_short . ".xspf";
$mw_mix_conf = $mwbe_conf_dir . $mw_mix_title_short . ".xml";
$mw_mix_html = $mwbe_html_dir . $mw_mix_title_short . ".html";
$mw_mix_allow_embed = "0"; // produce the code to embed your MixWidget tapes. 0=yes 1=no
$mw_mix_allow_archive = "0"; // produce a link to download a track archive for each mixwidget tape. 0=yes 1=no

// Skins Text Placement
// You can add skins if you understand the following logic. Read the conf files for each tape ax and ay are artist x and ay, tx and ty are track x and track y */

$mw_skin_img = $_POST['skin_img'];
// Will replace with associative array later so skins can be added more easily
if ($mw_skin_img == "tak-sa-x.jpg") {
	$mw_skin_tx = "120";
	$mw_skin_ty = "125";
	$mw_skin_ax = "35";
	$mw_skin_ay = "125";
} elseif ($mw_skin_img == "son-clear-green.jpg") {
	$mw_skin_tx = "85";
	$mw_skin_ty = "14";
	$mw_skin_ax = "35";
	$mw_skin_ay = "29";
} elseif ($mw_skin_img == "realistic.jpg") {
	$mw_skin_tx = "35";
	$mw_skin_ty = "39";
	$mw_skin_ax = "35";
	$mw_skin_ay = "26";
} elseif ($mw_skin_img == "interfunk.jpg") {
	$mw_skin_tx = "85";
	$mw_skin_ty = "17";
	$mw_skin_ax = "85";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "Crown.jpg") {
	$mw_skin_tx = "120";
	$mw_skin_ty = "17";
	$mw_skin_ax = "85";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "orwo-ugly.jpg") {
	$mw_skin_tx = "52";
	$mw_skin_ty = "29";
	$mw_skin_ax = "56";
	$mw_skin_ay = "12";
} elseif ($mw_skin_img == "AGFA_ferrocolor.jpg") {
	$mw_skin_tx = "59";
	$mw_skin_ty = "15";
	$mw_skin_ax = "65";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "agfa-purple.jpg") {
	$mw_skin_tx = "160";
	$mw_skin_ty = "15";
	$mw_skin_ax = "160";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "agfa-roscata.jpg") {
	$mw_skin_tx = "59";
	$mw_skin_ty = "15";
	$mw_skin_ax = "65";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "Agfa_Verde.jpg") {
	$mw_skin_tx = "59";
	$mw_skin_ty = "15";
	$mw_skin_ax = "65";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "agfa-yellow.jpg") {
	$mw_skin_tx = "59";
	$mw_skin_ty = "15";
	$mw_skin_ax = "65";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "Lucky.jpg") {
	$mw_skin_tx = "80";
	$mw_skin_ty = "10";
	$mw_skin_ax = "90";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "audiomagnetics_ugly.jpg") {
	$mw_skin_tx = "50";
	$mw_skin_ty = "18";
	$mw_skin_ax = "55";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "Audio_Magnetics_Extra.jpg") {
	$mw_skin_tx = "59";
	$mw_skin_ty = "15";
	$mw_skin_ax = "60";
	$mw_skin_ay = "40";
} elseif ($mw_skin_img == "baby-blue.jpg") {
	$mw_skin_tx = "59";
	$mw_skin_ty = "15";
	$mw_skin_ax = "60";
	$mw_skin_ay = "40";
} elseif ($mw_skin_img == "BASF.jpg") {
	$mw_skin_tx = "140";
	$mw_skin_ty = "15";
	$mw_skin_ax = "140";
	$mw_skin_ay = "33";
} elseif ($mw_skin_img == "Broadway.jpg") {
	$mw_skin_tx = "28";
	$mw_skin_ty = "15";
	$mw_skin_ax = "190";
	$mw_skin_ay = "15";
} elseif ($mw_skin_img == "elfra-yellow.jpg") {
	$mw_skin_tx = "20";
	$mw_skin_ty = "120";
	$mw_skin_ax = "160";
	$mw_skin_ay = "120";
} elseif ($mw_skin_img == "exclusiv.jpg") {
	$mw_skin_tx = "160";
	$mw_skin_ty = "18";
	$mw_skin_ax = "160";
	$mw_skin_ay = "39";
} elseif ($mw_skin_img == "hita-ex.jpg") {
	$mw_skin_tx = "50";
	$mw_skin_ty = "18";
	$mw_skin_ax = "50";
	$mw_skin_ay = "39";
} elseif ($mw_skin_img == "international.jpg") {
	$mw_skin_tx = "20";
	$mw_skin_ty = "120";
	$mw_skin_ax = "160";
	$mw_skin_ay = "120";
} elseif ($mw_skin_img == "lime-green.jpg") {
	$mw_skin_tx = "74";
	$mw_skin_ty = "17";
	$mw_skin_ax = "74";
	$mw_skin_ay = "34";
} elseif ($mw_skin_img == "low-noise-green.jpg") {
	$mw_skin_tx = "58";
	$mw_skin_ty = "17";
	$mw_skin_ax = "35";
	$mw_skin_ay = "34";
} elseif ($mw_skin_img == "mallory_fliptape.jpg") {
	$mw_skin_tx = "54";
	$mw_skin_ty = "17";
	$mw_skin_ax = "54";
	$mw_skin_ay = "34";
} elseif ($mw_skin_img == "marvel.jpg") {
	$mw_skin_tx = "74";
	$mw_skin_ty = "17";
	$mw_skin_ax = "74";
	$mw_skin_ay = "34";
} elseif ($mw_skin_img == "master.jpg") {
	$mw_skin_tx = "124";
	$mw_skin_ty = "17";
	$mw_skin_ax = "99";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "max-udii.jpg") {
	$mw_skin_tx = "120";
	$mw_skin_ty = "125";
	$mw_skin_ax = "35";
	$mw_skin_ay = "125";
} elseif ($mw_skin_img == "max-XLII.jpg") {
	$mw_skin_tx = "120";
	$mw_skin_ty = "125";
	$mw_skin_ax = "35";
	$mw_skin_ay = "125";
} elseif ($mw_skin_img == "mrt-china.jpg") {
	$mw_skin_tx = "54";
	$mw_skin_ty = "17";
	$mw_skin_ax = "54";
	$mw_skin_ay = "34";
} elseif ($mw_skin_img == "orwo.jpg") {
	$mw_skin_tx = "54";
	$mw_skin_ty = "14";
	$mw_skin_ax = "54";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "permaton.jpg") {
	$mw_skin_tx = "54";
	$mw_skin_ty = "25";
	$mw_skin_ax = "54";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "Phil-happy.jpg") {
	$mw_skin_tx = "70";
	$mw_skin_ty = "20";
	$mw_skin_ax = "70";
	$mw_skin_ay = "35";
} elseif ($mw_skin_img == "philips.jpg") {
	$mw_skin_tx = "65";
	$mw_skin_ty = "15";
	$mw_skin_ax = "25";
	$mw_skin_ay = "30";
} elseif ($mw_skin_img == "realistic.jpg") {
	$mw_skin_tx = "110";
	$mw_skin_ty = "10";
	$mw_skin_ax = "80";
	$mw_skin_ay = "25";
} elseif ($mw_skin_img == "royal.jpg") {
	$mw_skin_tx = "54";
	$mw_skin_ty = "8";
	$mw_skin_ax = "54";
	$mw_skin_ay = "22";
} elseif ($mw_skin_img == "shanghaipai.jpg") {
	$mw_skin_tx = "34";
	$mw_skin_ty = "40";
	$mw_skin_ax = "170";
	$mw_skin_ay = "40";
} elseif ($mw_skin_img == "unbespielt.jpg") {
	$mw_skin_tx = "34";
	$mw_skin_ty = "130";
	$mw_skin_ax = "170";
	$mw_skin_ay = "130";
} elseif ($mw_skin_img == "univerisum.jpg") {
	$mw_skin_tx = "20";
	$mw_skin_ty = "38";
	$mw_skin_ax = "210";
	$mw_skin_ay = "38";
} elseif ($mw_skin_img == "TPII_90.jpg") {
	$mw_skin_tx = "120";
	$mw_skin_ty = "15";
	$mw_skin_ax = "85";
	$mw_skin_ay = "26";
} elseif ($mw_skin_img == "AMC_120.jpg") {
	$mw_skin_tx = "60";
	$mw_skin_ty = "15";
	$mw_skin_ax = "28";
	$mw_skin_ay = "35";
}
?>

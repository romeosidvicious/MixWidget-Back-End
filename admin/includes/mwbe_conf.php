<?php

//Nothing below this line should need editing

if (isset($_GET['action'])) {
	$_SESSION['action'] = $_GET['action'];
} elseif (isset($_POST['action'])) {
	$_SESSION['action'] = $_POST['action'];
} else {
	$_SESSION['action'] = "index";
}

$_SESSION['mwbe_dir'] = preg_replace('/(\/admin)(.+)($)/', "", $_SERVER['PHP_SELF']);
$_SESSION['mwbe_admin_path'] = $_SESSION['mwbe_dir'] . $_SESSION['mwbe_admin_dir'];
$_SESSION['mwbe_server_path'] = $_SERVER["DOCUMENT_ROOT"] . $_SESSION['mwbe_dir'];
$_SESSION['mwbe_rel_path'] = "../";
$_SESSION['mwbe_base_url'] = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$_SESSION['mwbe_site_url'] = "http://" . $_SERVER["HTTP_HOST"] . $_SESSION['mwbe_dir'];
$_SESSION['mwbe_writable_dirs'] = array("/mixes/");
$_SESSION['mwbe_mix_dir'] = "/mixes/";
$_SESSION['mwbe_admin_dir'] = "/admin/";
$_SESSION['mwbe_temp_dir'] = $_SESSION['mwbe_admin_path'] . "/temp/";


if ($_SESSION['mw_skin_img'] == "tak-sa-x.jpg") {
	$_SESSION['mw_skin_tx'] = "120";
	$_SESSION['mw_skin_ty'] = "125";
	$_SESSION['mw_skin_ax'] = "35";
	$_SESSION['mw_skin_ay'] = "125";
} elseif ($_SESSION['mw_skin_img'] == "son-clear-green.jpg") {
	$_SESSION['mw_skin_tx'] = "85";
	$_SESSION['mw_skin_ty'] = "14";
	$_SESSION['mw_skin_ax'] = "35";
	$_SESSION['mw_skin_ay'] = "29";
} elseif ($_SESSION['mw_skin_img'] == "realistic.jpg") {
	$_SESSION['mw_skin_tx'] = "35";
	$_SESSION['mw_skin_ty'] = "39";
	$_SESSION['mw_skin_ax'] = "35";
	$_SESSION['mw_skin_ay'] = "26";
} elseif ($_SESSION['mw_skin_img'] == "interfunk.jpg") {
	$_SESSION['mw_skin_tx'] = "85";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "85";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "Crown.jpg") {
	$_SESSION['mw_skin_tx'] = "120";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "85";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "orwo-ugly.jpg") {
	$_SESSION['mw_skin_tx'] = "52";
	$_SESSION['mw_skin_ty'] = "29";
	$_SESSION['mw_skin_ax'] = "56";
	$_SESSION['mw_skin_ay'] = "12";
} elseif ($_SESSION['mw_skin_img'] == "AGFA_ferrocolor.jpg") {
	$_SESSION['mw_skin_tx'] = "59";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "65";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "agfa-purple.jpg") {
	$_SESSION['mw_skin_tx'] = "160";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "160";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "agfa-roscata.jpg") {
	$_SESSION['mw_skin_tx'] = "59";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "65";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "Agfa_Verde.jpg") {
	$_SESSION['mw_skin_tx'] = "59";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "65";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "agfa-yellow.jpg") {
	$_SESSION['mw_skin_tx'] = "59";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "65";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "Lucky.jpg") {
	$_SESSION['mw_skin_tx'] = "80";
	$_SESSION['mw_skin_ty'] = "10";
	$_SESSION['mw_skin_ax'] = "90";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "audiomagnetics_ugly.jpg") {
	$_SESSION['mw_skin_tx'] = "50";
	$_SESSION['mw_skin_ty'] = "18";
	$_SESSION['mw_skin_ax'] = "55";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "Audio_Magnetics_Extra.jpg") {
	$_SESSION['mw_skin_tx'] = "59";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "60";
	$_SESSION['mw_skin_ay'] = "40";
} elseif ($_SESSION['mw_skin_img'] == "baby-blue.jpg") {
	$_SESSION['mw_skin_tx'] = "59";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "60";
	$_SESSION['mw_skin_ay'] = "40";
} elseif ($_SESSION['mw_skin_img'] == "BASF.jpg") {
	$_SESSION['mw_skin_tx'] = "140";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "140";
	$_SESSION['mw_skin_ay'] = "33";
} elseif ($_SESSION['mw_skin_img'] == "Broadway.jpg") {
	$_SESSION['mw_skin_tx'] = "28";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "190";
	$_SESSION['mw_skin_ay'] = "15";
} elseif ($_SESSION['mw_skin_img'] == "elfra-yellow.jpg") {
	$_SESSION['mw_skin_tx'] = "20";
	$_SESSION['mw_skin_ty'] = "120";
	$_SESSION['mw_skin_ax'] = "160";
	$_SESSION['mw_skin_ay'] = "120";
} elseif ($_SESSION['mw_skin_img'] == "exclusiv.jpg") {
	$_SESSION['mw_skin_tx'] = "160";
	$_SESSION['mw_skin_ty'] = "18";
	$_SESSION['mw_skin_ax'] = "160";
	$_SESSION['mw_skin_ay'] = "39";
} elseif ($_SESSION['mw_skin_img'] == "hita-ex.jpg") {
	$_SESSION['mw_skin_tx'] = "50";
	$_SESSION['mw_skin_ty'] = "18";
	$_SESSION['mw_skin_ax'] = "50";
	$_SESSION['mw_skin_ay'] = "39";
} elseif ($_SESSION['mw_skin_img'] == "international.jpg") {
	$_SESSION['mw_skin_tx'] = "20";
	$_SESSION['mw_skin_ty'] = "120";
	$_SESSION['mw_skin_ax'] = "160";
	$_SESSION['mw_skin_ay'] = "120";
} elseif ($_SESSION['mw_skin_img'] == "lime-green.jpg") {
	$_SESSION['mw_skin_tx'] = "74";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "74";
	$_SESSION['mw_skin_ay'] = "34";
} elseif ($_SESSION['mw_skin_img'] == "low-noise-green.jpg") {
	$_SESSION['mw_skin_tx'] = "58";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "35";
	$_SESSION['mw_skin_ay'] = "34";
} elseif ($_SESSION['mw_skin_img'] == "mallory_fliptape.jpg") {
	$_SESSION['mw_skin_tx'] = "54";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "54";
	$_SESSION['mw_skin_ay'] = "34";
} elseif ($_SESSION['mw_skin_img'] == "marvel.jpg") {
	$_SESSION['mw_skin_tx'] = "74";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "74";
	$_SESSION['mw_skin_ay'] = "34";
} elseif ($_SESSION['mw_skin_img'] == "master.jpg") {
	$_SESSION['mw_skin_tx'] = "124";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "99";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "max-udii.jpg") {
	$_SESSION['mw_skin_tx'] = "120";
	$_SESSION['mw_skin_ty'] = "125";
	$_SESSION['mw_skin_ax'] = "35";
	$_SESSION['mw_skin_ay'] = "125";
} elseif ($_SESSION['mw_skin_img'] == "max-XLII.jpg") {
	$_SESSION['mw_skin_tx'] = "120";
	$_SESSION['mw_skin_ty'] = "125";
	$_SESSION['mw_skin_ax'] = "35";
	$_SESSION['mw_skin_ay'] = "125";
} elseif ($_SESSION['mw_skin_img'] == "mrt-china.jpg") {
	$_SESSION['mw_skin_tx'] = "54";
	$_SESSION['mw_skin_ty'] = "17";
	$_SESSION['mw_skin_ax'] = "54";
	$_SESSION['mw_skin_ay'] = "34";
} elseif ($_SESSION['mw_skin_img'] == "orwo.jpg") {
	$_SESSION['mw_skin_tx'] = "54";
	$_SESSION['mw_skin_ty'] = "14";
	$_SESSION['mw_skin_ax'] = "54";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "permaton.jpg") {
	$_SESSION['mw_skin_tx'] = "54";
	$_SESSION['mw_skin_ty'] = "25";
	$_SESSION['mw_skin_ax'] = "54";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "Phil-happy.jpg") {
	$_SESSION['mw_skin_tx'] = "70";
	$_SESSION['mw_skin_ty'] = "20";
	$_SESSION['mw_skin_ax'] = "70";
	$_SESSION['mw_skin_ay'] = "35";
} elseif ($_SESSION['mw_skin_img'] == "philips.jpg") {
	$_SESSION['mw_skin_tx'] = "65";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "25";
	$_SESSION['mw_skin_ay'] = "30";
} elseif ($_SESSION['mw_skin_img'] == "realistic.jpg") {
	$_SESSION['mw_skin_tx'] = "110";
	$_SESSION['mw_skin_ty'] = "10";
	$_SESSION['mw_skin_ax'] = "80";
	$_SESSION['mw_skin_ay'] = "25";
} elseif ($_SESSION['mw_skin_img'] == "royal.jpg") {
	$_SESSION['mw_skin_tx'] = "54";
	$_SESSION['mw_skin_ty'] = "8";
	$_SESSION['mw_skin_ax'] = "54";
	$_SESSION['mw_skin_ay'] = "22";
} elseif ($_SESSION['mw_skin_img'] == "shanghaipai.jpg") {
	$_SESSION['mw_skin_tx'] = "34";
	$_SESSION['mw_skin_ty'] = "40";
	$_SESSION['mw_skin_ax'] = "170";
	$_SESSION['mw_skin_ay'] = "40";
} elseif ($_SESSION['mw_skin_img'] == "unbespielt.jpg") {
	$_SESSION['mw_skin_tx'] = "34";
	$_SESSION['mw_skin_ty'] = "130";
	$_SESSION['mw_skin_ax'] = "170";
	$_SESSION['mw_skin_ay'] = "130";
} elseif ($_SESSION['mw_skin_img'] == "univerisum.jpg") {
	$_SESSION['mw_skin_tx'] = "20";
	$_SESSION['mw_skin_ty'] = "38";
	$_SESSION['mw_skin_ax'] = "210";
	$_SESSION['mw_skin_ay'] = "38";
} elseif ($_SESSION['mw_skin_img'] == "TPII_90.jpg") {
	$_SESSION['mw_skin_tx'] = "120";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "85";
	$_SESSION['mw_skin_ay'] = "26";
} elseif ($_SESSION['mw_skin_img'] == "AMC_120.jpg") {
	$_SESSION['mw_skin_tx'] = "60";
	$_SESSION['mw_skin_ty'] = "15";
	$_SESSION['mw_skin_ax'] = "28";
	$_SESSION['mw_skin_ay'] = "35";
}
?>
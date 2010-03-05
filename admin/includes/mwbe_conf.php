<?php

$tapes = array (
	"tak-sa-x.jpg" => array("tx" => "120", "ty" => "125", "ax" => "35", "ay" => "125"),
	"son-clear-green.jpg" => array("tx" => "85", "ty" => "14", "ax" => "35", "ay" => "29"),
	"realistic.jpg" => array("tx" => "35", "ty" => "39", "ax" => "35", "ay" => "26"),
	"interfunk.jpg" => array("tx" => "85", "ty" => "17", "ax" => "85", "ay" => "30"),
	"Crown.jpg" => array("tx" => "120", "ty" => "17", "ax" => "85", "ay" => "30"),
	"orwo-ugly.jpg" => array("tx" => "52", "ty" => "29", "ax" => "56", "ay" => "12"),
	"AGFA_ferrocolor.jpg" => array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33"),
	"agfa-purple.jpg" => array("tx" => "160", "ty" => "15", "ax" => "160", "ay" => "33"),
	"agfa-roscata.jpg" => array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33"),
	"Agfa_Verde.jpg" => array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33"),
	"agfa-yellow.jpg" => array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33"),
	"Lucky.jpg" => array("tx" => "80", "ty" => "10", "ax" => "90", "ay" => "30"),
	"audiomagnetics_ugly.jpg" => array("tx" => "50", "ty" => "18", "ax" => "55", "ay" => "33"),
	"Audio_Magnetics_Extra.jpg" => array("tx" => "59", "ty" => "15", "ax" => "60", "ay" => "40"),
	"baby-blue.jpg" => array("tx" => "59", "ty" => "15", "ax" => "60", "ay" => "40"),
	"BASF.jpg" => array("tx" => "140", "ty" => "15", "ax" => "140", "ay" => "33"),
	"Broadway.jpg" => array("tx" => "28", "ty" => "15", "ax" => "190", "ay" => "15"),
	"elfra-yellow.jpg" => array("tx" => "20", "ty" => "120", "ax" => "160", "ay" => "120"),
	"exclusiv.jpg" => array("tx" => "160", "ty" => "18", "ax" => "160", "ay" => "39"),
	"hita-ex.jpg" => array("tx" => "50", "ty" => "18", "ax" => "55", "ay" => "39"),
	"international.jpg" => array("tx" => "20", "ty" => "120", "ax" => "160", "ay" => "120"),
	"lime-green.jpg" => array("tx" => "74", "ty" => "17", "ax" => "74", "ay" => "34"),
	"low-noise-green.jpg" => array("tx" => "58", "ty" => "17", "ax" => "35", "ay" => "34"),
	"mallory_fliptape.jpg" => array("tx" => "54", "ty" => "17", "ax" => "54", "ay" => "34"),
	"marvel.jpg" => array("tx" => "74", "ty" => "17", "ax" => "74", "ay" => "34"),
	"master.jpg" => array("tx" => "124", "ty" => "17", "ax" => "99", "ay" => "30"),
	"max-udii.jpg" => array("tx" => "120", "ty" => "125", "ax" => "35", "ay" => "125"),
	"max-XLII.jpg" => array("tx" => "120", "ty" => "125", "ax" => "35", "ay" => "125"),
	"mrt-china.jpg" => array("tx" => "54", "ty" => "17", "ax" => "54", "ay" => "34"),
	"orwo.jpg" => array("tx" => "54", "ty" => "14", "ax" => "54", "ay" => "30"),
	"permaton.jpg" => array("tx" => "54", "ty" => "25", "ax" => "54", "ay" => "30"),
	"Phil-happy.jpg" => array("tx" => "70", "ty" => "20", "ax" => "70", "ay" => "35"),
	"philips.jpg" => array("tx" => "65", "ty" => "15", "ax" => "25", "ay" => "30"),
	"realistic.jpg" => array("tx" => "110", "ty" => "10", "ax" => "80", "ay" => "25"),
	"royal.jpg" => array("tx" => "54", "ty" => "8", "ax" => "54", "ay" => "22"),
	"shanghaipai.jpg" => array("tx" => "34", "ty" => "40", "ax" => "170", "ay" => "40"),
	"unbespielt.jpg" => array("tx" => "34", "ty" => "130", "ax" => "170", "ay" => "130"),
	"univerisum.jpg" => array("tx" => "20", "ty" => "38", "ax" => "210", "ay" => "38"),
	"TPII_90.jpg" => array("tx" => "120", "ty" => "15", "ax" => "85", "ay" => "26"),
	"AMC_120.jpg" => array("tx" => "60", "ty" => "15", "ax" => "28", "ay" => "35")
);

class ConfigCommon {
	var $MWBE = array();
	public function SetConf() {
		$this->MWBE['ROOT'] = preg_replace('/(\/admin)(.+)($)/', "", $_SERVER['PHP_SELF']);
		$this->MWBE['ADMIN_PATH'] = $this->MWBE['ROOT'] . $this->MWBE['ADMIN_DIR'];
		$this->MWBE['SERVER_PATH'] = $_SERVER["DOCUMENT_ROOT"] . $this->MWBE['ROOT'];
		$this->MWBE['REL_PATH'] = "../";
		$this->MWBE['BASE_URL'] = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$this->MWBE['SITE_URL'] = "http://" . $_SERVER["HTTP_HOST"] . $this->MWBE['ROOT'];
		$this->MWBE['MIX_DIR'] = "/mixes/";
		$this->MWBE['ADMIN_DIR'] = "/admin/";
		$this->MWBE['TEMP_DIR'] = $_SESSION['mwbe_admin_path'] . "/temp/";
		$this->MWBE['SKINS_DIR'] = "/skins/";
	}
	var $ACTION;
	public function SetAction() {
		if (isset($_GET['action'])) {
			$this->Action = $_GET['action'];
		} elseif (isset($_POST['action'])) {
			$this->Action = $_POST['action'];
		} else {
			$this->Action = "index";
		}

	}
	public $MWBE;
	public $ACTION;
}
$static_conf = new ConfigCommon();
$static_conf->SetConf();
$static_conf->SetAction();
?>
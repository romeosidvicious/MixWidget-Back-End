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
	public function SetConf() {
		$this->ROOT = preg_replace('/(\/admin)(.+)($)/', "", $_SERVER['PHP_SELF']); //MWBE install root
		$this->SRV_PATH = $_SERVER["DOCUMENT_ROOT"] . $this->ROOT; //Path to MWBE root on filesystem
		$this->SITE_URL = "http://" . $_SERVER["HTTP_HOST"] . $this->ROOT; //Web path to MWBE
		$this->ADMIN_DIR = "/admin/";
		$this->MIX_DIR = "/mixes/";
		$this->TEMP_DIR = "/temp/";
		$this->SKINS_DIR = "/skins/";
		$this->INC_DIR = "/includes/";
		$this->IMG_DIR = "/images/";
		$this->ADMIN_PATH = $this->SRV_PATH . $this->ADMIN_DIR; //FS path to MWBE admin dir
		$this->MIX_PATH = $this->SRV_PATH . $this->MIX_DIR; //FS path to mixes dir
		$this->TEMP_PATH = $this->ADMIN_PATH . $this->TEMP_DIR; //FS path to temp dir
		$this->SKINS_PATH = $this->SRV_PATH . $this->SKINS_DIR; //FS path to skins dir
		$this->INC_PATH = $this->ADMIN_PATH . $this->INC_DIR; //FS path to includes dir
		$this->IMG_PATH = $this->ADMIN_PATH . $this->IMG_DIR; //FS path to images dir
		$this->ADMIN_URL = $this->SITE_URL . $this->ADMIN_DIR; //Web path to MWBE admin dir
		$this->MIX_URL = $this->SITE_URL . $this->MIX_DIR; //Web path to mixes dir
		$this->TEMP_URL = $this->ADMIN_URL . $this->TEMP_DIR; //Web path to temp dir
		$this->SKINS_URL = $this->SITE_URL . $this->SKINS_DIR; //Web path to skins dir
		$this->INC_URL = $this->ADMIN_URL . $this->INC_DIR; //Web path to includes dir
		$this->IMG_URL = $this->ADMIN_URL . $this->IMG_DIR; //Web path to images dir		
	}
	
	public function SetAction() {
		if (isset($_GET['action'])) {
			$this->Action = $_GET['action'];
		} elseif (isset($_POST['action'])) {
			$this->Action = $_POST['action'];
		} else {
			$this->Action = "index";
		}

	}
}

$static_conf = new ConfigCommon();
$static_conf->SetConf();
$static_conf->SetAction();
?>
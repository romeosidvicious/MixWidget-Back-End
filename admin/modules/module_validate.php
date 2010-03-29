<?php
/*
 * This modules provides validation functionality to MWBE
 */
class ValidateFile {
	public function page_content(){
		echo "<div id=\"content\">
	<div align=\"center\"<h2>Make a Mix - Processing Upload...</h2></div>
	<div class=\"selections\">
	Your choices so far:
	The title for your mix will be: " . $_SESSION['mw_mix_title'] . "<br />
	The artist for your mix is: " . $_SESSION['mw_mix_artist'] . "<br />
	Your selected skin image is:<br />
	<img width=\"100\" src= \"" . $_SESSION['mwbe_site_url'] . "/" . $_SESSION['mwbe_skins_dir'] . "/" . $_SESSION['mw_skin_img'] . "\"><br />
	</div>";
	}
		
	public function verify_file($file_name){
		global $static_conf;
		$file_ext=end(explode('.', $file_name));
		$finfo=finfo_open(FILEINFO_MIME);
		$file_mime_type=finfo_file($finfo, $file_name);
		if($file_ext="zip"){
			$this->ext_whitelist=array('zip');
			$this->type_whitelist=array('application/x-compressed', 'application/x-zip-compressed', 'application/zip');
			$this->type_blacklist=array('multipart/x-zip');
		}elseif($file_ext="tgz") {
			$this->ext_whitelist=array('gz','gzip');
			$this->type_whitelist=array('application/x-gzip', 'x-compressed');
			$this->type_blacklist=array('multipart/x-gzip');
		}elseif($file_ext="tbz"){
			$this->ext_whitelist=array('boz','bz','bz2','bzip','bzip2');
			$this->type_whitelist=array('application/x-bzip','application/x-bzip2');
			$this->type_blacklist=NULL;
		}elseif($file_ext="tar"){
			$this->ext_whitelist=array('tar');
			$this->type_whitelist=array('application/x-tar');
			$this->type_blacklist=NULL;
		}elseif($file_ext="jpg"){
			$this->ext_whitelist=array('jfif','jfif-tbnl','jpe','jpeg','jpg');
			$this->type_whitelist=array('image/jpeg','image/pjpeg');
			$this->type_blacklist=array('video/x-motion-jpeg');
		}elseif($file_ext="png"){
			$this->ext_whitelist=array('png','x-png');
			$this->type_whitelist=array('image/png','image/png');
			$this->type_blacklist=NULL;
		}elseif($file_ext="mp3"){
			$this->ext_whitelist=array('mp3');
			$this->type_whitelist=array('audio/mpeg3','audio/x-mpeg-3');
			$this->type_blacklist=NULL;
		}else{
			$this->ext_whitelist=array('mp3', 'png','x-png','jfif','jfif-tbnl','jpe','jpeg','jpg');
			$this->type_whitelist=array('audio/mpeg3','audio/x-mpeg-3','image/png','image/png','image/jpeg','image/pjpeg',);
			$this->type_blacklist=array('video/x-motion-jpeg');
		}
		$this->$master_ext_blacklist=array('php', 'php3', 'php4', 'phtml','exe','sh','js','html');

		if(in_array($file_ext, $this->$master_ext_blacklist)){
			unlink($file_name);
			echo "<h2>$file_name has the extension $file_ext which is disallowed in MWBE and has been removed for your safety.</h2>\n";
		}elseif(!is_null($this->type_blacklist)){
			if(in_array($file_mime_type, $this->type_blacklist)){
				echo "<h2>$file_name matches a mime type that is disallowed for security reasons and has been removed for your safety.</h2>\n";
			}
		}elseif(!in_array($file_mime_type, $this->type_whitelist)){
			echo "<h2>$file_name matches no known mime type that is allowed in MWBE and has been removed for your safety.</h2>\n";
		}
	}
}
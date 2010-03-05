<?php
/*
 * This modules provides validation functionality to MWBE
 */
function file_info($static_conf, &$file_type, &$file_ext, &$file_mime_type, &$file_name, &$ext_whitelist, &$type_whitelist, &$type_blacklist, &$master_ext_blacklist){
	if(isset($_POST['file_type'])){
		$file_type=$_POST['file_type'];
	}else{
		$file_type=NULL;
	}
	$file_ext=end(explode('.', $file_name));
	$finfo=finfo_open(FILEINFO_MIME);
	$file_mime_type=finfo_file($finfo, $file_name);
	if($file_type="zip"){
		$ext_whitelist=array('zip');
		$type_whitelist=array('application/x-compressed', 'application/x-zip-compressed', 'application/zip');
		$type_blacklist=array('multipart/x-zip');
	}elseif($file_type="tgz") {
		$ext_whitelist=array('gz','gzip');
		$type_whitelist=array('application/x-gzip', 'x-compressed');
		$type_blacklist=array('multipart/x-gzip');
	}elseif($file_type="tbz"){
		$ext_whitelist=array('boz','bz','bz2','bzip','bzip2');
		$type_whitelist=array('application/x-bzip','application/x-bzip2');
		$type_blacklist=NULL;
	}elseif($file_type="tar"){
		$ext_whitelist=array('tar');
		$type_whitelist=array('application/x-tar');
		$type_blacklist=NULL;
	}elseif($file_type="jpg"){
		$ext_whitelist=array('jfif','jfif-tbnl','jpe','jpeg','jpg');
		$type_whitelist=array('image/jpeg','image/pjpeg');
		$type_blacklist=array('video/x-motion-jpeg');
	}elseif($file_type="png"){
		$ext_whitelist=array('png','x-png');
		$type_whitelist=array('image/png','image/png');
		$type_blacklist=NULL;
	}elseif($file_type="mp3"){
		$ext_whitelist=array('mp3');
		$type_whitelist=array('audio/mpeg3','audio/x-mpeg-3');
		$type_blacklist=NULL;
	}else{
		$ext_whitelist=array('mp3', 'png','x-png','jfif','jfif-tbnl','jpe','jpeg','jpg');
		$type_whitelist=array('audio/mpeg3','audio/x-mpeg-3','image/png','image/png','image/jpeg','image/pjpeg',);
		$type_blacklist=array('video/x-motion-jpeg');
	}
	$master_ext_blacklist=array('php', 'php3', 'php4', 'phtml','exe','sh','js','html');
}

function val_up_file($static_conf, &$file_type, &$file_ext, &$file_mime_type, &$file_name, &$ext_whitelist, &$type_whitelist, &$type_blacklist, &$master_ext_blacklist){
	file_info();
	if(in_array($file_ext, $master_ext_blacklist)){
		unlink($file_name);
		echo "<h2>$file_name has the extension $file_ext which is disallowed in MWBE and has been removed for your safety.</h2>\n";
	}elseif(!is_null($type_blacklist)){
		if(in_array($file_mime_type, $type_blacklist)){
			echo "<h2>$file_name matches a mime type that is disallowed for security reasons and has been removed for your safety.</h2>\n";
		}
	}elseif(!in_array($file_mime_type, $type_whitelist)){
		echo "<h2>$file_name matches no known mime type that is allowed in MWBE and has been removed for your safety.</h2>\n";
	}
}

function val_extracted_file($static_conf, &$file_type, &$file_ext, &$file_mime_type, &$file_name, &$ext_whitelist, &$type_whitelist, &$type_blacklist, &$master_ext_blacklist){
	file_info();
	if(in_array($file_ext, $master_ext_blacklist)){
		unlink($file_name);
		echo "<h2>$file_name has the extension $file_ext which is disallowed in MWBE and has been removed for your safety.</h2>\n";
	}elseif(!is_null($type_blacklist)){
		if(in_array($file_mime_type, $type_blacklist)){
			echo "<h2>$file_name matches a mime type that is disallowed for security reasons and has been removed for your safety.</h2>\n";
		}
	}elseif(!in_array($file_mime_type, $type_whitelist)){
		echo "<h2>$file_name matches no known mime type that is allowed in MWBE and has been removed for your safety.</h2>\n";
	}
}

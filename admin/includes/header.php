<?php
echo <<<_END
<html>
<head>
	<link type="text/css" rel="stylesheet" href="includes/style.css">
	<script src='includes/js/jquery-1.4.2.min.js' type="text/javascript"></script>
	<script src='includes/js/jquery.jmpopups-0.5.1.js' type="text/javascript"></script>
	<script src='includes/js/jquery.MultiFile.js' type="text/javascript"></script>
	<!-- <script src='inlcudes/js/jmpopups.mwbe.conf.js' type="text/javascript"></script> -->
	<script type="text/javascript">
			//<![CDATA[
$.setupJMPopups( {
	screenLockerBackground : "#003366",
	screenLockerOpacity : "0.7"
});

function openZipPopup() {
	$.openPopupLayer( {
		name : "zipPopUp",
		width : 550,
		url : "docs/zip.php"
	});
}

function openSizePopup() {
	$.openPopupLayer( {
		name : "sizePopUp",
		width : 300,
		url : "docs/size.php"
	});
}

function openFTPPopup() {
	$.openPopupLayer( {
		name : "ftpPopUp",
		width : 300,
		url : "../docs/ftp.php"
	});
}

function openCoverPopup() {
	$.openPopupLayer( {
		name : "coverPopUp",
		width : 300,
		url : "../docs/cover.php"
	});
}

function openMiscPopup() {
	$.openPopupLayer( {
		name : "miscPopUp",
		width : 300,
		url : "../docs/misc.php"
	});
}

function openMP3Popup() {
	$.openPopupLayer( {
		name : "mp3PopUp",
		width : 300,
		url : "../docs/mp3.php"
	});
}

function openTARPopup() {
	$.openPopupLayer( {
		name : "tarPopUp",
		width : 300,
		url : "../docs/tar.php"
	});
}

function openID3Popup() {
	$.openPopupLayer( {
		name : "id3PopUp",
		width : 300,
		url : "../docs/id3.php"
	});
}
//]]>
</script>
	
	<title>The MixWidget Back End</title>
</head>
<body>
	<div id="banner">
		<h1>MixWidget Back End 1.0 beta 1</h1>
	</div>
_END;
?>
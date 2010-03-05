$.setupJMPopups( {
	screenLockerBackground : "#003366",
	screenLockerOpacity : "0.7"
});

function openZipPopup() {
	$.openPopupLayer( {
		name : "zipPopUp",
		width : 550,
		url : "../docs/zip.php"
	});
}

function openSizePopup() {
	$.openPopupLayer( {
		name : "sizePopUp",
		width : 300,
		url : "../docs/size.php"
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
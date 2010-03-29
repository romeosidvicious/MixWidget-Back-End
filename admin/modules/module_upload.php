<?php
/*
 * This file provides file upload functionality for MWBE
 */

class UpFile {
	
	public function page_content(){
		global $static_conf;
		echo "<div id=\"content\">
		<h2>Time to get your music on...</h2>
		<div class=\"selections\">
		Your choices so far:<br /><br />
		The title for your mix will be: " . $_SESSION['title'] . "<br />
		The artist for your mix is: " . $_SESSION['artist'] . "<br />
		Your selected skin image is:<br />
		<img height=\"150\" src= \"" . $static_conf->SKINS_URL . $_SESSION['skin'] . "\"><br />
		</div>
	<div class=\"popper\">
	For information on the various ways you can upload files and possible issues please click on one of the following topics:
	<table class=\"popper\">
	<tr>
	<td><a href=\"javascript:;\" onclick=\"openZipPopup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "zip.png\" /><br />zip files</a></td>
	<td><a href=\"javascript:;\" onclick=\"openTARPopup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "tar.png\" /><br />tar files</td>
	<td><a href=\"javascript:;\" onclick=\"openMP3Popup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "mp3.png\" /><br />single mp3 files</td>
	<td><a href=\"javascript:;\" onclick=\"openCoverPopup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "jpg.png\" /><br />cover images</td>
	</tr>
	<tr>
	<td><a href=\"javascript:;\" onclick=\"openSizePopup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "size.png\" /><br />file size</td>
	<td><a href=\"javascript:;\" onclick=\"openID3Popup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "id3.png\" /><br />id3 tags</td>
	<td><a href=\"javascript:;\" onclick=\"openFTPPopup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "ftp.png\" /><br />ftp uploads</td>
	<td><a href=\"javascript:;\" onclick=\"openMiscPopup()\" title=\"MWBE and zip files\"><img src=\"". $static_conf->IMG_URL . "misc.png\" /><br />misc. file types</td>
	<tr>
	</table>
	<form enctype=\"multipart/form-data\" action=\"index.php?action=verify\" method=\"POST\">
	Choose file(s) to upload: <input name=\"up_file\" type=\"file\" class=\"multi\" maxlength=\"10\" /><input type=\"submit\" value=\"Upload File(s)\" />
	</form>
	Or:
	<form action=\"index.php?action=verify\" method=\"POST\">
	Enter the name of the file you uploaded via FTP:<br /> 
	<input name=\"local_file\" type=\"text\" /><input type=\"submit\" value=\"Submit\" />
	</form>
	</div>";
	}
}
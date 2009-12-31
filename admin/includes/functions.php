<?php

function nav() {
	unset($_SESSION['index_class']);
	unset($_SESSION['editmix_class']);
	unset($_SESSION['validate_class']);
	unset($_SESSION['makemix_class']);
	unset($_SESSION['mwbedocs_class']);
	unset($_SESSION['upfiles_class']);
	if ($_SESSION['action'] == "index") {
		index();
	} elseif ($_SESSION['action'] == "makemix") {
		makemix();
	} elseif ($_SESSION['action'] == "upfiles") {
		upfiles();
	} elseif ($_SESSION['action'] == "verify") {
		verify();
	} elseif ($_SESSION['action'] == "validate") {
		validate();
	} elseif ($_SESSION['action'] == "editmix") {
		editmix();
	} elseif ($_SESSION['action'] == "mwbedocs") {
		mwbedocs();
	} elseif ($_SESSION['action'] == "delmix") {
		delmix();
	} else {
		index();
	}
}

function menu() {
	echo "<ul id=\"tabmenu\">
			<li><a " . $_SESSION['index_class'] . "href=\"index.php?action=index\">Main</a></li>
			<li><a " . $_SESSION['makemix_class'] . "href=\"index.php?action=makemix\">Make A Mix</a></li>
			<li><a " . $_SESSION['editmix_class'] . "href=\"index.php?action=editmix\">Edit Your Mixes</a></li>
			<li><a " . $_SESSION['mwbedocs_class'] . "href=\"index.php?action=mwbedocs\">Documentation</a></li>
			<li><a " . $_SESSION['validate_class'] . "href=\"index.php?action=validate\">Validate Installation</a></li>
		</ul>
		</div>";

}

function index() {
	$_SESSION['index_class'] = "class=\"active\"";
	menu();
	echo "<div id=\"content\">
		<h2>Welcome to the Mix Widget Backend</h2>
		Currently this interface is not very pretty and the only working functionality is making a mix by uploading a .zip file either via ftp or MWBE. 
		Please see the included TODO for information on the planned feature set.<br />
		The menu options perform the following actions:<br />
		<ul>
			<li>Main - Takes you to this page.</li>
			<li>Make A Mix - Takes you to the interface for making a mix.</li>
			<li>Edit Your Mixes - Is not currently implemented but will be where you go to edit existing mixes</li>
			<li>Documentation - Is currently empty but will contain documentation for MWBE</li>
			<li>Validate - Checks to see if all of the required files and directories exist and have the proper permissions.</li>
		</ul>";

	if (!glob($_SESSION['mwbe_server_path'] . $_SESSION['mwbe_writable_dirs']['confs'] . "*.xml")) {
		echo "You currrently have no mixes!<br />\n";
	} else {
		echo "<h2>You currently have the following mixes:</h2>\n";
		echo "This is a list of the mixes you have created using the Mix Widget Backend. (Clicking the mix will take you to the .html page for that mix):<br />
		<ul>\n";
		foreach (glob($_SESSION['mwbe_server_path'] . $_SESSION['mwbe_writable_dirs']['confs'] . "*.xml") as $xml) {
			$_SESSION['mix_name'] = basename($xml, ".xml");
			$conf_xml = simplexml_load_file("$xml");
			$mix_title = (string)$conf_xml->title;
			$_SESSION['mix_title'] =  $mix_title;
			// Once mix editing works: Add in a link to the html file and css to make and edit link that is visibly different.
			// echo "<a href=\"index.php?action=editmix&mix=$_SESSION['mix_name']\">$_SESSION['mix_title']</a><br />\n";
			echo "<li><a href=\"" . $_SESSION['mwbe_dir'] . "/mixes/" . $_SESSION['mix_name'] . ".html\">" . $_SESSION['mix_title'] . "</a><br /></li>\n";
		}
		echo "</ul>\n";
	}
}

function editmix() {
	$_SESSION['editmix_class'] = "class=\"active\"";
	menu();
	echo "<div id=\"content\">
	<h2>This version of MixWidget only supports deleting your mixes so if you mess up you have to upload your mix again.<br />Editing existing mixes is coming soon...</h2><br />\n";
	if(!glob($_SESSION['mwbe_server_path'] . $_SESSION['mwbe_writable_dirs']['confs'] . "*.xml")) {
		echo "You currrently have no mixes!<br />\n";
	} else {
		echo "<h2>You currently have the following mixes:</h2>\n";
		echo "This is a list of the mixes you have created using the Mix Widget Backend. Clicking the delete button will delete the mix that is listed with the button.<br />
		<h2>WARNING</h2>
		<strong>There is no verification for deleting mixes at the present time. If you press delete it WILL delete a mix without asking you to verify.</strong>
		<ul>\n";
		foreach(glob($_SESSION['mwbe_server_path'] . $_SESSION['mwbe_writable_dirs']['confs'] . "*.xml") as $xml) {
			$mix_name = basename($xml, ".xml");
			$conf_xml = simplexml_load_file("$xml");
			$mix_title = (string)$conf_xml->title;
			echo "<li>$mix_title - <form action=\"index.php?action=delmix\" method=\"post\"><input name=\"mix_title\" type=\"hidden\" value=\"$mix_title\"><input name=\"mix_name\" type=\"hidden\" value=\"$mix_name\"><input type=\"submit\" value=\"DELETE $mix_title!\"/></li>
			</form>
			";
		}
		echo "</ul>\n";
	}
}

function delmix() {
	$_SESSION['editmix_class'] = "class=\"active\"";
	menu();
	echo "<div id=\"content\">
	<h2>Removing " . $_POST['mix_title'] . " as requested</h2>
	<div class=\"process\">\n";

	foreach($_SESSION['mwbe_writable_dirs'] as $mix_del_dir) {
		switch($mix_del_dir) {
			case '/mixes/':
				echo "Removing html file for " . $_POST['mix_title'] . ":" . $_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".html<br />\n";
				echo "Removing include file for " . $_POST['mix_title'] . ":" . $_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".include<br />\n";
				unlink($_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".html");
				unlink($_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".include");
				break;
			case '/confs/':
				echo "Removing configuration file for " . $_POST['mix_title'] . ":" . $_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".xml<br />\n";
				unlink($_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".xml");
				break;
			case '/archives/':
				echo "Removing zip archive for " . $_POST['mix_title'] . ":"  . $_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".zip<br />\n";
				unlink($_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . ".zip");
				break;
			case '/tracks/':
				foreach(glob($_SESSION['mwbe_server_path'] . $mix_del_dir . $_POST['mix_name'] . "/*") as $mix_del_track) {
					echo "Removing track: $mix_del_track for " . $_POST['mix_title'] . "<br />\n";
					unlink($mix_del_track);
				}
				echo "Removing tracks directory for " . $_POST['mix_title'] . ":" . $_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name'] . "<br />\n";
				rmdir($_SESSION['mwbe_server_path'] . "$mix_del_dir" . $_POST['mix_name']);
				break;
		}
	}
	echo "</div>
	<h2>If You Don't See Any Errors We Deleted " .  $_POST['mix_title'] . " Successfully!</h2>
	<h2>If You Do See Errors Copy Them And Send Them To romeosidvicious [at] gmail so I can try and fix the issue.</h2>";

}

function makemix() {
	$_SESSION['makemix_class'] = "class=\"active\"";
	menu();
	echo "<div id=\"content\">
	<h2>Make a Mix - Choices, choices, choices...</h2>
	Simply fill in the following information and click submit!
	<form action=\"index.php?action=upfiles\" method=\"post\">
	Mix Title: <input name=\"mix_title\" value=\"Mix Title\" type=\"text\" /><br />
	Mix Artist: <input name=\"mix_artist\" value=\"Artist\" type=\"test\" /><br />
	Do you wish to link to an archive of the tracks in the mix: Yes <input name=\"mwbe_archive_allow\" type=\"Radio\" value=\"1\" /> No <input name=\"mwbe_archive_allow\" type=\"Radio\" value=\"0\" /><br />
	Do you wish to provide code to embed this mix on other sites: Yes <input name=\"mwbe_embed_allow\" type=\"Radio\" value=\"1\" /> No <input name=\"mwbe_embed_allow\" type=\"Radio\" value=\"0\" /><br />
	Please select a skin for your mix tape:<br />
	<table border=\"0\" cellpadding=\"1\">\n";

	$skin_count = 1;
	foreach (glob($_SESSION['mwbe_server_path'] . "/skins/*.jpg") as $skin) {
		$skin_img = str_replace($_SESSION['mwbe_server_path'] . "/skins/", '',$skin);
		if ($skin_count == 1){
			echo "\t<tr align=\"center\" valign=\"middle\">\n";
		}
		echo "\t\t<td><input name=\"skin_img\" type=\"Radio\" value=\"$skin_img\"><img align=\"middle\" height=\"64\" width=\"100\" src=\"" . $_SESSION['mwbe_site_url'] . "/skins/$skin_img\"><br />$skin_img</td>\n";
		$skin_count++;
		if ($skin_count == 7) {
			echo "\t</tr>\n";
			$skin_count = 1;
		}

	}
	echo "</table>
	<input type=\"submit\" />\n
	</form>\n
	<br /><br />";
}

function upfiles() {
	$_SESSION['makemix_class'] = "class=\"active\"";
	menu();
	$_SESSION['mw_mix_title'] = $_POST['mix_title'];
	$_SESSION['mw_mix_title_short'] = strtolower(preg_replace("/\W|\s/", "", $_SESSION['mw_mix_title']));
	$_SESSION['mw_mix_artist'] = $_POST['mix_artist'];
	$_SESSION['mw_mix_tracks_dir'] = $_SESSION['mwbe_writable_dirs']['tracks'] . $_SESSION['mw_mix_title_short'] . "/";
	$_SESSION['mw_mix_archive'] = $_SESSION['mwbe_writable_dirs']['archives'] . $_SESSION['mw_mix_title_short'] . ".zip";
	$_SESSION['mw_mix_playlist'] = $_SESSION['mwbe_writable_dirs']['playlists'] . $_SESSION['mw_mix_title_short'] . ".xspf";
	$_SESSION['mw_mix_conf'] = $_SESSION['mwbe_writable_dirs']['confs'] . $_SESSION['mw_mix_title_short'] . ".xml";
	$_SESSION['mw_mix_html'] = $_SESSION['mwbe_writable_dirs']['mixes'] . $_SESSION['mw_mix_title_short'] . ".html";
	$_SESSION['mw_mix_include'] = $_SESSION['mwbe_writable_dirs']['mixes'] . $_SESSION['mw_mix_title_short'] . ".include";
	$_SESSION['mw_skin_img'] = $_POST['skin_img'];
	$_SESSION['mw_mix_allow_archive'] = $_POST['mwbe_archive_allow'];
	$_SESSION['mw_mix_allow_embed'] = $_POST['mwbe_embed_allow'];
	echo "<div id=\"content\">
		<h2>Make a Mix - Upload a .zip file...</h2>
		<div class=\"selections\">
		Your choices so far:
		The title for your mix will be: " . $_SESSION['mw_mix_title'] . "<br />
		The artist for your mix is: " . $_SESSION['mw_mix_artist'] . "<br />
		Your selected skin image is:<br />
		<img height=\"64\" width=\"100\" src= \"" . $_SESSION['mwbe_site_url'] . "/skins/" . $_SESSION['mw_skin_img'] . "\"><br />
		</div>
		<h2>Select a .zip file containing the mp3 files you wish to use for your compilation.</h2>
		<div class=\"directions\">
			Some quick tips on formatting your MP3 file names:<br />
			(These tips are due to limitations in MixWidget Frontend that I hope to fix in future releases.)
		<text class=\"good\">
		<ul>
			<li>Your files will be added to the playlist in alphabetical order so please name them with that in mind.</li>
			<ul>
				<li>I suggest the following naming structure ##-songtitle.mp3 like: <i>01-mutiny.mp3</i></li>
			</ul>
			<li>Your files will be renamed to remove any special characters and spaces so don't worry about this beforehand.</li>
			<ul>
				<li>For instance <i>01 - Sinead O'Connor - Nothing Compares To You.mp3</i> will be <i>01-sineadoconnor-nothingcomparestoyou.mp3</i> after processing</li>
			</ul>
		</ul>
		</text>
		The .zip file must meet the following specifications or it will be removed to prevent any malicious uploads:
		<text class=\"warn\">
		<ul>
			<li>Contain ONLY MP3 files and single cover.jpg.</li>
			<li>Contain no path information. MixWidget Frontend doesn't parse any farther than the root of the zip file.</li>
			<li>Contain no password information.</li>
			<li>Not be a multi-part zip.</li>
		</ul>
		</text>
		All of the files contained in the .zip file must meet the following specifications:
		<text class=\"warn\">
		<ul>
			<li>All MP3s must be verifiable as MP3 files.</li>
			<li>All MP3s must contain valid ID3v2 tags.</li>
		</ul>
		</text>
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

function verify() {
	$_SESSION['makemix_class'] = "class=\"active\"";
	menu();
	echo "<div id=\"content\">
	<div align=\"center\"<h2>Make a Mix - Processing Upload...</h2></div>
	<div class=\"selections\">
	Your choices so far:
	The title for your mix will be: " . $_SESSION['mw_mix_title'] . "<br />
	The artist for your mix is: " . $_SESSION['mw_mix_artist'] . "<br />
	Your selected skin image is:<br />
	<img height=\"64\" width=\"100\" src= \"" . $_SESSION['mwbe_site_url'] . "/skins/" . $_SESSION['mw_skin_img'] . "\"><br />
	</div>";

	$zip_ext_whitelist = array('zip');
	$mp3_ext_whitelist = array('mp3');
	$img_whitelist = array('jpg');
	$mp3_type = array('audio/mpeg3', 'audio/x-mpeg-3', 'audio/x-mpg', 'audio/mpeg', 'audio/x-mpeg', 'audio/x-mp3', 'audio/x-mpeg3', 'audio/x-mpg', 'audio/x-mpegaudio');
	$zip_type = array('application/x-compressed', 'application/x-zip-compressed', 'application/zip');
	$zip_type_blacklist = ('multipart/x-zip');
	$blacklist = array('php', 'php3', 'php4', 'phtml','exe');
	$ver_tracks_dir = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_tracks_dir'];
	$up_archive = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_archive'];
	$up_name_only = basename($up_name);
	$up_archive_name_only = basename($up_archive);

	if($_FILES['zipfile']['size'] > 0) {
		$up_name = $_SESSION['mwbe_server_path'] . $_SESSION['mwbe_writable_dirs']['archives'] . basename($_FILES['zipfile']['name']);
		$up_lc = strtolower($_FILES['zipfile']['name']);
		if(!move_uploaded_file($_FILES['zipfile']['tmp_name'], $up_name)) {
			echo "uploaded file: " . $_FILES['zipfile']['tmp_name'] . "<br />\n";
			echo "f_name: $f_name <br />\n";
			echo "up_name: $up_name <br />\n";
			echo "<text class=\"bad\">There was an error uploading the file.</text><br />\n";
			exit(0);
		} elseif(!in_array(end(explode('.', $up_lc)), $zip_ext_whitelist)) {
			echo "<text class=\"bad\">" . $_FILES['zipfile']['name'] . " is not a .zip file and has been removed.</text><br />\n";
			exit(0);
		}
	} elseif(isset($_POST['localzipfile'])) {
		$local_zip_name = $_POST['localzipfile'];
		$up_name = $_SESSION['mwbe_server_path'] . $_SESSION['mwbe_writable_dirs']['archives'] . "/" . basename($_POST['localzipfile']);
		if(!copy($local_zip_name, $up_name)) {
			echo "<text class=\"bad\">The local file could not be copied for use with MixWidget backend. Please check the path and your file permissions and try again.</text><br />\n";
			exit(0);
		} elseif(!in_array(explode('.', strtolower($_POST['localzipfile'])), $zip_ext_whitelist)) {

		}
	}
	$zip = new ZipArchive;
	if ($zip->open("$up_name") === TRUE) {
		mkdir("$ver_tracks_dir", 0775);
		$zip->extractTo($ver_tracks_dir);
		$zip->close();
		echo "Tracks for " . $_SESSION['mw_mix_title'] . "extracted from $up_name_only successfully!<br />\n";
		if (rename("$up_name", "$up_archive")) {
			echo "Uploaded file: $up_name_only has been renamed to $up_archive_name_only to allow downloading of the track archive...<br /><br />\n";
		} else {
			echo "There was a problem re-naming $up_name_only to $up_archive_name_only. No track archive will be available for download.<br />\n";
		}
	} else {
		echo "There was a problem extracting the files from $up_name_only and it has been removed for security reasons.<br />\n";
		unlink($up_name);
		exit(0);
	}

	$pl_playlist = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_playlist'];
	$pl_head = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
	<!-- generator=\"MixWidget Back End\" -->
	<playlist version=\"1\" xmlns=\"http://xspf.org/ns/0/\">
	\t<trackList>\n";
	$f_pl_head = fopen("$pl_playlist", "w");
	fwrite($f_pl_head, $pl_head);
	fclose($f_pl_head);
	echo "<h3>Processing MP3s now...</h3>
	<div class=\"process\">\n";
	foreach (glob("$ver_tracks_dir*.mp3") as $pre_song) {
		$pre_song_name_only = basename($pre_song);
		echo "<text class=\"pr_head\">Processing $pre_song_name_only...<br /></text>\n";
		$post_song = basename($pre_song, ".mp3");
		$post_song = str_replace("/[^a-zA-Z0-9s]/", "", $post_song); // remove any non alpha-numeric characters
		$post_song = str_replace(" ", "", $post_song); //remove any spaces
		$post_song = strtolower($post_song); // make it lower case to avoid issues on case sensitive systems
		$post_song = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_tracks_dir'] . $post_song . ".mp3";
		$post_song_name_only = basename($post_song);
		if (!rename("$pre_song", "$post_song")) {
			echo "failed to rename $pre_song_name_only to $post_song_name_only<br />\n";
		} else {
			if (!in_array(end(explode('.', $post_song)), $mp3_ext_whitelist)) {
				echo "$post_song_name_only is not an MP3 and has been removed for security reasons.<br />\n";
				fclose($post_song);
				unlink($post_song);
			} else {
				echo "...attempting to process ID3 fields for $post_song_name_only<br />\n";
				$getid3 = new getID3;
				$getid3->analyze("$post_song");
				echo "...$post_song_name_only is a valid MP3 and is being added to your playlist<br />\n";
				if (@$getid3->info['tags']) {
					foreach ($getid3->info['tags'] as $tag => $tag_info) {
						if (@$getid3->info['tags'][$tag]['title']) {
							$pl_artist = @$getid3->info['tags'][$tag]['artist'][0];
							$pl_title  = @$getid3->info['tags'][$tag]['title'][0];
							$pl_time   = @$getids->info['playtime_seconds'];
							$pl_mp3 = basename($post_song);
						} else {
							$pl_title = basename($pre_song, ".mp3");
							$pl_mp3 = basename($post_song);
						}
					}
				} else {
					$pl_title = basename($pre_song, ".mp3");
					$pl_mp3 = basename($post_song);
				}
			}
			echo "<text class=\"pr_foot\">...$pl_title by $pl_artist has been added to your playlist!</text><br /><br />\n";
			$pl_full_path = $_SESSION['mwbe_site_url'] . $_SESSION['mwbe_writable_dirs']['tracks'] . $_SESSION['mw_mix_title_short'] . "/" . htmlentities($pl_mp3, ENT_QUOTES);
			$tr_text = "\t\t<track>
			\t\t\t<location>$pl_full_path</location>
			\t\t\t<creator>$pl_artist</creator>
			\t\t\t<album>" . $_SESSION['mw_mix_title'] . "</album>
			\t\t\t<title>$pl_title</title>
			\t\t\t<duration>$pl_time</duration>
			\t\t</track>\n";
			$f_pl_tr = fopen("$pl_playlist", "a");
			fwrite($f_pl_tr, $tr_text);
			fclose($f_pl_tr);
		}
	}
	echo "</div>";

	$pl_foot = "\t</trackList>
	</playlist>";
	$f_pl_foot = fopen("$pl_playlist", "a");
	fwrite($f_pl_foot, $pl_foot);
	fclose($f_pl_foot);
	echo "<text class=\"pr_foot\">Your playlist has been created...</text><br />\n<text class=\"pr_foot\">Creating the MixWidget configuration file now...</text><br />\n";
	makeconf();
	echo "<text class=\"pr_foot\">Configuration file complete making html file now...</text><br />\n";
	makehtml();
	echo "<text class=\"pr_foot\">Your mix has been successfully created!</text><br /><br />
	You may:
	<ul>
	<li><a href=\"" . $_SESSION['mwbe_site_url'] . $_SESSION['mwbe_writable_dirs']['mixes'] .  $_SESSION['mw_mix_title_short'] . ".html\">View the .html file</a></li>
	<li><a href=\"index.php\">Return to the Mix Widget Backend \"Main\" page.</li>
	<li><a href=\"" . $_SESSION['mwbe_site_url'] . $_SESSION['mwbe_mixes_index'] . "\">View your Mix Widget Backend site index</a></li>
	</ul>";
}

function makeconf() {
	switch($_SESSION['mw_skin_img']) {
		case "tak-sa-x.jpg":
			$mw_skin_text = array("tx" => "120", "ty" => "125", "ax" => "35", "ay" => "125");
			break;
		case "son-clear-green.jpg":
			$mw_skin_text = array("tx" => "85", "ty" => "14", "ax" => "35", "ay" => "29");
			break;
		case "realistic.jpg":
			$mw_skin_text = array("tx" => "35", "ty" => "39", "ax" => "35", "ay" => "26");
			break;
		case "interfunk.jpg":
			$mw_skin_text = array("tx" => "85", "ty" => "17", "ax" => "85", "ay" => "30");
			break;
		case "Crown.jpg":
			$mw_skin_text = array("tx" => "120", "ty" => "17", "ax" => "85", "ay" => "30");
			break;
		case "orwo-ugly.jpg":
			$mw_skin_text = array("tx" => "52", "ty" => "29", "ax" => "56", "ay" => "12");
			break;
		case "AGFA_ferrocolor.jpg":
			$mw_skin_text = array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33");
			break;
		case "agfa-purple.jpg":
			$mw_skin_text = array("tx" => "160", "ty" => "15", "ax" => "160", "ay" => "33");
			break;
		case "agfa-roscata.jpg":
			$mw_skin_text = array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33");
			break;
		case "Agfa_Verde.jpg":
			$mw_skin_text = array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33");
			break;
		case "agfa-yellow.jpg":
			$mw_skin_text = array("tx" => "59", "ty" => "15", "ax" => "65", "ay" => "33");
			break;
		case "Lucky.jpg":
			$mw_skin_text = array("tx" => "80", "ty" => "10", "ax" => "90", "ay" => "30");
			break;
		case "audiomagnetics_ugly.jpg":
			$mw_skin_text = array("tx" => "50", "ty" => "18", "ax" => "55", "ay" => "33");
			break;
		case "Audio_Magnetics_Extra.jpg":
			$mw_skin_text = array("tx" => "59", "ty" => "15", "ax" => "60", "ay" => "40");
			break;
		case "baby-blue.jpg":
			$mw_skin_text = array("tx" => "59", "ty" => "15", "ax" => "60", "ay" => "40");
			break;
		case "BASF.jpg":
			$mw_skin_text = array("tx" => "140", "ty" => "15", "ax" => "140", "ay" => "33");
			break;
		case "Broadway.jpg":
			$mw_skin_text = array("tx" => "28", "ty" => "15", "ax" => "190", "ay" => "15");
			break;
		case "elfra-yellow.jpg":
			$mw_skin_text = array("tx" => "20", "ty" => "120", "ax" => "160", "ay" => "120");
			break;
		case "exclusiv.jpg":
			$mw_skin_text = array("tx" => "160", "ty" => "18", "ax" => "160", "ay" => "39");
			break;
		case "hita-ex.jpg":
			$mw_skin_text = array("tx" => "50", "ty" => "18", "ax" => "50", "ay" => "39");
			break;
		case "international.jpg":
			$mw_skin_text = array("tx" => "20", "ty" => "120", "ax" => "160", "ay" => "120");
			break;
		case "lime-green.jpg":
			$mw_skin_text = array("tx" => "74", "ty" => "17", "ax" => "74", "ay" => "34");
			break;
		case "low-noise-green.jpg":
			$mw_skin_text = array("tx" => "58", "ty" => "17", "ax" => "35", "ay" => "34");
			break;
		case "mallory_fliptape.jpg":
			$mw_skin_text = array("tx" => "54", "ty" => "17", "ax" => "54", "ay" => "34");
			break;
		case "marvel.jpg":
			$mw_skin_text = array("tx" => "74", "ty" => "17", "ax" => "74", "ay" => "34");
			break;
		case "master.jpg":
			$mw_skin_text = array("tx" => "124", "ty" => "17", "ax" => "99", "ay" => "30");
			break;
		case "max-udii.jpg":
			$mw_skin_text = array("tx" => "120", "ty" => "125", "ax" => "35", "ay" => "125");
			break;
		case "max-XLII.jpg":
			$mw_skin_text = array("tx" => "120", "ty" => "125", "ax" => "35", "ay" => "125");
			break;
		case "mrt-china.jpg":
			$mw_skin_text = array("tx" => "54", "ty" => "17", "ax" => "54", "ay" => "34");
			break;
		case "orwo.jpg":
			$mw_skin_text = array("tx" => "54", "ty" => "14", "ax" => "54", "ay" => "30");
			break;
		case "permaton.jpg":
			$mw_skin_text = array("tx" => "54", "ty" => "25", "ax" => "54", "ay" => "30");
			break;
		case "Phil-happy.jpg":
			$mw_skin_text = array("tx" => "70", "ty" => "20", "ax" => "70", "ay" => "35");
			break;
		case "philips.jpg":
			$mw_skin_text = array("tx" => "65", "ty" => "15", "ax" => "25", "ay" => "30");
			break;
		case "realistic.jpg":
			$mw_skin_text = array("tx" => "110", "ty" => "10", "ax" => "80", "ay" => "25");
			break;
		case "royal.jpg":
			$mw_skin_text = array("tx" => "54", "ty" => "8", "ax" => "54", "ay" => "22");
			break;
		case "shanghaipai.jpg":
			$mw_skin_text = array("tx" => "34", "ty" => "40", "ax" => "170", "ay" => "40");
			break;
		case "unbespielt.jpg":
			$mw_skin_text = array("tx" => "34", "ty" => "130", "ax" => "170", "ay" => "130");
			break;
		case "univerisum.jpg":
			$mw_skin_text = array("tx" => "20", "ty" => "38", "ax" => "210", "ay" => "38");
			break;
		case "TPII_90.jpg":
			$mw_skin_text = array("tx" => "120", "ty" => "15", "ax" => "85", "ay" => "26");
			break;
		case "AMC_120.jpg":
			$mw_skin_text = array("tx" => "60", "ty" => "15", "ax" => "28", "ay" => "35");
	}
	$conf_whole = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<widget version=\"2.1\" flashVersion=\"9.0.0\">
	\t<title>" . $_SESSION['mw_mix_title'] . "</title> <!-- shown at opening -->
	\t<creator>" . $_SESSION['mw_mix_artist'] . "</creator><!-- shown at opening -->
	\t<!-- <image rotation=\"0\" x=\"0\" scale=\"25\" y=\"0\" mask=\"full\"></image> -->
	\t<!-- comment out image tag to remove image -->
	\t<skin imageEnabled=\"true\">
	\t\t<!--set imageEnabled to anything but true to disable -->
    \t\t<shadow>0</shadow>                   <!-- 0-100 -->
    \t\t<gloss>30</gloss>                    <!-- 0-100 -->
    \t\t<outlines>20</outlines>              <!-- 0-100 -->
    \t\t<frameColor>CCCCCC</frameColor>      <!-- hex color-->
    \t\t<bodyColor>66CCFF</bodyColor>        <!-- hex color-->
    \t\t<gearboxColor>CCCCCC</gearboxColor>  <!-- hex color-->
    \t\t<gearColor>598B9F</gearColor>        <!-- hex color-->
    \t\t<threaderColor>CCCCCC</threaderColor><!-- hex color-->
    \t\t<text size=\"18\" color=\"000000\" bgAlpha=\"0\" bgColor=\"FFFFFF\" align=\"LEFT\"></text>
    \t\t<!-- bgAlpha = 0-100, align = LEFT, CENTER, RIGHT -->
	\t\t<trackText x=\"" . $mw_skin_text['tx'] . "\" y=\"" . $mw_skin_text['ty'] . "\" width=\"260\"></trackText>
    \t\t<artistText x=\"" . $mw_skin_text['ax'] . "\" y=\"" . $mw_skin_text['ay'] . "\" width=\"260\"></artistText>
    \t</skin>
    </widget>";
	$ver_conf = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_conf'];
	$f_conf = fopen("$ver_conf", "w");
	fwrite($f_conf, $conf_whole);
	fclose($f_conf);

}

function makehtml() {
	$flash_src = $_SESSION['mwbe_site_url'] . "/mixwidget/mixwidget.swf";
	$flash_var_config = $_SESSION['mwbe_site_url'] . $_SESSION['mwbe_writable_dirs']['confs'] . $_SESSION['mw_mix_title_short'] . ".xml";
	$flash_var_pl = $_SESSION['mwbe_site_url'] . $_SESSION['mw_mix_playlist'];
	$flash_var_skin = $_SESSION['mwbe_site_url'] . "/skins/" . $_SESSION['mw_skin_img'];
	if(file_exists((string)$_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_tracks_dir'] . "cover.jpg")) {
		$html_cover = "<img src=\"" . $_SESSION['mwbe_site_url'] . $_SESSION['mw_mix_tracks_dir'] . "cover.jpg\">";
	}
	if ($_SESSION['mw_mix_allow_archive'] == "1") {
		$html_archive = "<a href=\"" . $_SESSION['mwbe_site_url'] . $_SESSION['mwbe_writable_dirs']['archives'] . $_SESSION['mw_mix_title_short'] . '.zip' . "\">Track Archive</a>";
	}
	if ($_SESSION['mw_mix_allow_embed'] == "1") {
		$html_embed = "<div class=\"embed\"><code>&lt;embed type=\"application/x-shockwave-flash\" width=\"430\" height=\"330\" src=\"$flash_src\" wmode=\"transparent\" flashvars=\"config=$flash_var_config&playlist=$flash_var_pl&skin=$flash_var_skin\"&gt;&lt;/embed&gt;</code></div>";
	}
	$mwbe_html_page = "<html>
	<head>
	\t<link type=\"text/css\" rel=\"stylesheet\" href=\"../includes/style.css\">
	\t<title>" . $_SESSION['mw_mix_title'] . " - via MixWidget Backend</title>
	<head>
	<body>
	\t<div class=\"tape\">
	\t\t$html_cover<br />
	\t\t<embed type=\"application/x-shockwave-flash\" width=\"430\" height=\"330\" src=\"$flash_src\" wmode=\"transparent\" flashvars=\"config=$flash_var_config&playlist=$flash_var_pl&skin=$flash_var_skin\"></embed><br />
	\t\t$html_archive<br />
	\t\t$html_embed<br />
	\t</div>
	</body>
	</html>";
	$ver_html = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_html'];
	$f_html = fopen("$ver_html", "w");
	fwrite($f_html, $mwbe_html_page);
	fclose($f_html);
	$index_mix_embed = "<hr />
	<div class=\"tape\">
	<h2>" . $_SESSION['mw_mix_title'] . "</h2>
	$html_cover<br />
	<embed type=\"application/x-shockwave-flash\" width=\"430\" height=\"330\" src=\"$flash_src\" wmode=\"transparent\" flashvars=\"config=$flash_var_config&playlist=$flash_var_pl&skin=$flash_var_skin\"></embed>
	<br />
	$html_archive<br />
	$html_embed<br />
	</div><br />
	<hr />";
	$ver_include = $_SESSION['mwbe_server_path'] . $_SESSION['mw_mix_include'];
	$f_mixes = fopen("$ver_include", "a");
	fwrite($f_mixes, $index_mix_embed);
	fclose($f_mixes);
}

function validate() {
	$_SESSION['validate_class'] = "class=\"active\"";
	menu();
	echo "<div id=\"content\">
		<h2>Directory and File Validation</h2>
		To re-check simply <a href=\"index.php?action=validate\">click here</a> or on the Validate menu option above.<br />
		Once everything in both of the lists below is green then <a href=\"index.php?action=\"def\">click here</a> or click Main in the above menu.<br />\n";

	$rdir_arr = array("/mixwidget", "/resources", "/mixwidget/mixwidget.swf", "/mixwidget/.DS_Store", "/resources/expressInstall.swf", "/resources/swfobject.js", "/resources/.DS_Store", "/skins");
	echo "<div class=\"checks\"><h2>Writable File and Directory Checks</h2>\n";
	foreach ($_SESSION['mwbe_writable_dirs'] as $wvalue) {
		$wfile_test = $_SESSION['mwbe_server_path'] . $wvalue;
		if (is_writable($wfile_test)) {
			echo "<text class=\"good\">$wfile_test exists and is writable.</text><br />\n";
		} elseif (file_exists($wfile_test)) {
			echo "<text class=\"bad\">$wfile_test exists but is not writable.</text><br />\n";
		} elseif (is_writable($_SESSION['mwbe_dir'])) {
			if ($wvalue == $_SESSION['mwbe_mixes_index']) {
				fopen ($_SESSION['mwbe_mixes_index'], "w");
			} else {
				mkdir ("$wfile_test", 0775);
			}
			echo "<text class=\"warn\">$wfile_test did not exist but was created for you.</text><br />\n";
		} else {
			echo "<text class=\"bad\">$wfile_test does not exist and cannot be created for you.</text><br />\n";
		}
	}
	echo "</div>
	<div class=\"directions\"><p class=\"warn\">The recommended configuration is for the above files and directories to be writable by the user and webserver but not world. How you accomplish this depends on your webhost. However if you have to chmod dirs to 777 and then get hacked don't blame me. If you have a webhost that forces you to use 777 perms to create web writable directories then it's time to find a new one.</p>
<p>Any directory or file listed above in <text class=\"good\">green</text /> is configured to allow MixWidget Frontend to work properly but could still have insecure permissions.</p>
<p>Any directory or file listed about in <text class=\"warn\">orange</text /> did not exist but has been created for you and has permissions as secure as possible for MixWidget Frontend to work properly</p>
<p>And directory or file listed above in <text class=\"bad\">red</text /> either has permissions to restrictive for MixWidget Frontend to work properly or does not exist and cannot be created. In which case you will have to manually set the permissions or in the case of the directory or file not exists re-read the INSTALL document included with MixWidget Frontend.</p>
</div>
<div class=\"checks\"><h2>Readable File and Directory Checks</h2>\n";

	// Exists and Readable Check
	foreach ($rdir_arr as $rvalue) {
		$rfile_test = $_SESSION['mwbe_server_path'] . $rvalue;
		if (file_exists($rfile_test)) {
			echo "<text class=\"good\">$rfile_test exists and is readable.</text><br />\n";
		} else {
			echo "<text class=\"bad\">$rfile_test does not exist.</text><br />\n";
		}
	}
	echo "</div>
	<div class=\"directions\"><p class=\"warn\">The checks run on the files above only verify that they exist and can be read by MixWidget Frontend. This does not insure that these files have secure permissions.</p>
<p>Any file or directory listed above in <text class=\"good\">green</text /> has at least the minimum permissions necessary for MixWidget Frontent to function properly.</p>
<p>Any file or directory listed above in <text class=\"bad\">red</text /> does not exist.</p>
<p class=\"warn\">Any missing files or directories in this list will cause MixWidget Frontend not to function properly. Please read the INSTALL document and correct any errors above before attempting to use MixWidget Frontend.</p>
</div>\n";
	clearstatcache();

}

function mwbedocs() {
	$_SESSION['mwbedocs_class'] = "class=\"active\"";
	menu();
}
?>
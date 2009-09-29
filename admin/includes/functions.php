<?php

function menu() {
	global $action;
	if ($action =="def") {
		def();
	} elseif ($action == "makemix") {
		makemix();
	} elseif ($action == "upfiles") {
		upfiles();
	} elseif ($action == "verify") {
		verify();
	} elseif ($action == "validate") {
		validate();
	} else {
		def();
	}
}


function def() {
	global $mwbe_dir;
	echo <<<_END
			<ul id="tabmenu">
			<li><a class="active" href="mwbe.php?action=def">Main</a>
			<li><a href="mwbe.php?action=makemix">Make A Mix</a>
		</ul>
		<div id="content">
			<ul>
				<li><a href="mwbe.php?action=validate">Validate the File Structure</a /></li />
				<li>Create a Mix by Uploading Single Files</li />
				<li>Create a Mix by Uploading a .zip File</li />
				<li>Create a Mix by Uploading a .tar File</li />
				<li>List Current Mixes</li />
			</ul />
		This isn't pretty yet and it won't be until the functionality is complete so deal with it.
		</div />
_END;
}


function makemix() {
	global $mwbe_site_url, $mwbe_server_path, $mw_mix_title, $mw_mix_artist, $mw_mix_title_short, $mwbe_tracks_dir, $mwbe_playlist_dir, $mwbe_conf_dir, $mwbe_html_dir, $mwbe_skins_dir, $mw_skin_img, $mw_skin_tx, $mw_skin_ty, $mw_skin_ax, $mw_skin_ay, $mwbe_conf_skel, $html_skel, $mixes_index, $mwbe_cover_img, $mwbe_conf_dir, $mwbe_up_dir;

	echo <<<_END
	<ul id="tabmenu">
		<li><a href="mwbe.php?action=def">Main</a>
		<li><a class="active" href="mwbe.php?action=makemix">Make A Mix</a>
		
		
	</ul>
	<div id="content">
	<h1>This will be where you can edit your existing mixes or create new mixes based on files you uploaded.</h1 />
_END;

	echo "<form action=\"mwbe.php?action=upfiles\" method=\"post\">\n
Mix Title: <input name=\"mix_title\" value=\"Mix Title\" type=\"text\" />\n
<br />\n
Mix Artist: <input name=\"mix_artist\" value=\"Artist\" type=\"test\" />\n
<br />\n
Please select a skin for your mix tape:<br />\n";
	echo "<table border=\"0\" cellpadding=\"1\" />";

	$skin_count = 1;
	foreach (glob("$mwbe_server_path/$mwbe_skins_dir/*.jpg") as $skin) {
		$skin_img = str_replace("$mwbe_server_path/$mwbe_skins_dir/", '',$skin);
		if ($skin_count == 1){
			echo "<tr align=\"center\" valign=\"middle\">";
		}
		echo "<td><input name=\"skin_img\" type=\"Radio\" value=\"$skin_img\"><img align=\"middle\" height=\"64\" width=\"100\" src=\"$mwbe_site_url/skins/$skin_img\"><br />\n$skin_img\n</td />\n";
		$skin_count++;
		if ($skin_count == 7) {
			echo "</tr />";
			$skin_count = 1;
		}

	}
	echo "<table />";
	echo "<input type=\"submit\" />\n
</form>\n
<br /><br />";
}


function upfiles() {
	global $mwbe_server_path, $mw_mix_title, $mw_mix_artist, $mw_mix_title_short, $mwbe_tracks_dir, $mwbe_playlist_dir, $mwbe_html_dir, $mwbe_skins_dir, $mw_skin_img, $mw_skin_tx, $mw_skin_ty, $mw_skin_ax, $mw_skin_ay, $mwbe_conf_skel, $html_skel, $mixes_index, $mwbe_cover_img, $mwbe_conf_dir, $mwbe_up_dir, $mwbe_tracks_dir;

	echo <<<_END
	<ul id="tabmenu">
		<li><a href="mwbe.php?action=def">Main</a>
		<li><a class="active" href="mwbe.php?action=makemix">Make A Mix</a>
	</ul>
	<div id="content">
		The title for your mix will be: $mw_mix_title<br />\n
		The Artist for your mix is: $mw_mix_artist<br />\n
		Your tracks will be stored in $mwbe_tracks_dir/$mw_mix_title_short<br />\n
		Your playlist will be $mwbe_playlist_dir/$mw_mix_title_short.xspf<br />\n
		Your configuration file will be $mwbe_conf_dir/$mw_mix_title_short.xml<br />\n
		You selected skin image $mw_skin_img<br />\n
		Your artist text will be: x $mw_skin_ax y $mw_skin_ay<br />\n
		Your track text will be: x $mw_skin_tx y $mw_skin_ty<br />\n
		<h2>Select a .zip file containing the mp3 files you wish to use for your compilation.</h2 />
		<div class="directions">
			Some quick tips on formatting your MP3 file names:<br />
			(These tips are due to limitations in MixWidget Frontend that I hope to fix in future releases.)
		<text class="good">
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
		<text class="warn">
		<ul>
			<li>Contain ONLY MP3 files with a single optional cover image named cover.jpg</li>
			<li>Contain no path information. MixWidget Frontend doesn't parse any farther than the root of the zip file.</li>
			<li>Contain no password information.</li>
			<li>Not be a multi-part zip.</li>
		</ul>
		</text>
		All of the files contained in the .zip file must meet the following specifications:
		<text class="warn">
		<ul>
			<li>All MP3s must be verifiable as MP3 files.</li>
			<li>All MP3s must contain valid ID3v2 tags.</li>
			<li>cover.jpg must be verifiable as a .jpg.</li>
		</ul>
		</text>
		<text class="bad">If any SINGLE file fails the check above the whole archive will be removed and you will have to start over making your mix. Granular verification will be in a future version of this script but v0.1 verifies the archive as a whole and the files a whole directory. Sorry if this is inconvenient.</text>
	</div>
	<form enctype="multipart/form-data" action="mwbe.php?action=verify" method="POST">
	<input type="hidden" name="mix_title" value="$mw_mix_title" />
	<input type="hidden" name="mix_artist" value="$mw_mix_artist" />
	<input type="hidden" name="skin_img" value="$mw_skin_img" />
	<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
	Choose a zip file to upload: <input name="zipfile" type="file" /><input type="submit" value="Upload Zip File" />
	</form>
	</div>	
_END;
}


function verify() {
	echo <<<_END
	<ul id="tabmenu">
                <li><a href="mwbe.php?action=def">Main</a>
                <li><a class="active" href="mwbe.php?action=makemix">Make A Mix</a>
        </ul>
	<div id="content">
	<div align="center"<h2>Verifying your upload</h2></div>
_END;

	global $mwbe_rel_path, $mwbe_server_path, $mw_mix_title, $mw_mix_artist, $mw_mix_title_short, $mwbe_tracks_dir, $mwbe_playlist_dir, $mwbe_html_dir, $mwbe_skins_dir, $mw_skin_img, $mw_skin_tx, $mw_skin_ty, $mw_skin_ax, $mw_skin_ay, $mwbe_conf_skel, $html_skel, $mixes_index, $mwbe_cover_img, $mwbe_conf_dir, $mwbe_up_dir, $up_name, $mw_mix_tracks_dir, $mw_mix_archive, $mw_mix_playlist, $mwbe_web_dir, $mwbe_base_url, $mwbe_site_url;

	$zip_ext_whitelist = array('zip');
	$mp3_ext_whitelist = array('mp3');
	$img_whitelist = array('jpg');
	$mp3_type = array('audio/mpeg3', 'audio/x-mpeg-3', 'audio/x-mpg', 'audio/mpeg', 'audio/x-mpeg', 'audio/x-mp3', 'audio/x-mpeg3', 'audio/x-mpg', 'audio/x-mpegaudio');
	$zip_type = array('application/x-compressed', 'application/x-zip-compressed', 'application/zip');
	$zip_type_blacklist = ('multipart/x-zip');
	$blacklist = array('php', 'php3', 'php4', 'phtml','exe');
	$f_name = ( $_FILES['zipfile']['name']);
	global $up_name;
	$up_name = $mwbe_rel_path . $mwbe_up_dir . basename( $_FILES['zipfile']['name']);
	$up_lc = strtolower($_FILES['zipfile']['name']);
	$ver_tracks_dir = $mwbe_server_path . $mw_mix_tracks_dir;
	$up_archive = $mwbe_server_path . $mw_mix_archive;


	if (!move_uploaded_file($_FILES['zipfile']['tmp_name'], $up_name)) {
		echo "uploaded file" . $_FILES['zipfile']['tmp_name'] . "<br />\n";
		echo "f_name: $f_name <br />\n";
		echo "up_name: $up_name <br />\n";
		echo "<text class=\"bad\">There was an error uploading the file.</text><br />\n";
		tryagain();
	} elseif (!in_array(end(explode('.', $up_lc)), $zip_ext_whitelist)) {
		echo "$f_name is not a .zip file and has been removed.<br />";
		del_zip();
	} else {
		// zip file extraction
		$zip = new ZipArchive;
		if ($zip->open("$up_name") === TRUE) {
			mkdir("$ver_tracks_dir", 0775);
			$zip->extractTo($ver_tracks_dir);
			$zip->close();
			echo "Tracks for $mw_mix_title extracted from $up_name to $ver_tracks_dir successfully.<br />\n";
			if (rename("$up_name", "$up_archive")) {
				echo "Uploaded file $up_name has been renamed to $up_archive<br />\n";
			} else {
				echo "There was a problem re-naming $up_name to $up_archive. No track archive will be available for download.<br />\n";
			}
		} else {
			echo "There was a problem extracting the files from $up_name and it has been removed for security reasons.<br />\n";
			del_zip();
		}
	}

	echo "Finished processing zip file<br />\n"; // debug message - remove later

	// Play list creation and MP3 file verification
	// Set and write header for playlist
	$pl_playlist = $mwbe_server_path . $mw_mix_playlist;
	echo $pl_playlist;
	$pl_head = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
	<!-- generator=\"MixWidget Back End\" -->
	<playlist version=\"1\" xmlns=\"http://xspf.org/ns/0/\">
	\t<trackList>";
	$f_pl_head = fopen("$pl_playlist", "w");
	fwrite($f_pl_head, $pl_head);
	fclose($f_pl_head);
	// Set tracklist for playlist
	foreach (glob("$ver_tracks_dir*.mp3") as $pre_song) {
		echo "<div id=\"checks\"><p>Processing $pre_song<br />\n";
		$post_song = basename($pre_song, ".mp3");
		$post_song = str_replace("/[^a-zA-Z0-9s]/", "", $post_song); // remove any non alpha-numeric characters
		$post_song = str_replace(" ", "", $post_song); //remove any spaces
		$post_song = strtolower($post_song); // make it lower case to avoid issues on case sensitive systems
		$post_song = $mwbe_server_path . $mw_mix_tracks_dir . $post_song . ".mp3";
		if (!rename("$pre_song", "$post_song")) {
			echo "failed to rename $pre_song to $post_song<br />\n";
		} else {
			if (!in_array(end(explode('.', $post_song)), $mp3_ext_whitelist)) {
				echo "$post_song is not an MP3 and has been removed for security reasons.<br />\n";
				fclose($post_song);
				unlink($post_song);
			} else {
				echo "Attempting to process ID3 fields for $post_song...<br />\n";
				$getid3 = new getID3;
				$getid3->analyze("$post_song");
				echo "$post_song is a valid MP3 and is being added to your playlist<br />\n";
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
			//$pl_artist = urlencode($pl_artist);
			//$pl_title = urlencode($pl_title);
			echo $pl_mp3 . "<br />\n";
			echo htmlentities($pl_mp3, ENT_QUOTES) . "<br />\n";
			
			$pl_full_path = $mwbe_site_url . $mwbe_tracks_dir . $mw_mix_title_short . "/" . htmlentities($pl_mp3, ENT_QUOTES);
			echo "$pl_full_path being added to playlist now.<br />\n";
			$tr_text = "\t\t<track>
			\t\t\t<location>$pl_full_path</location>
			\t\t\t<creator>$pl_artist</creator>
			\t\t\t<album>$mw_mix_title</album>
			\t\t\t<title>$pl_title</title>
			\t\t\t<duration>$pl_time</duration>
			\t\t</track>\n";
			$f_pl_tr = fopen("$pl_playlist", "a");
			fwrite($f_pl_tr, $tr_text);
			fclose($f_pl_tr);
			echo "</p></div>\n";
		}
	}

	$pl_foot = "\t</trackList>\n</playlist>";
	$f_pl_foot = fopen("$pl_playlist", "a");
	fwrite($f_pl_foot, $pl_foot);
	fclose($f_pl_foot);
	echo "Your playlist has been created.<br />\nCreating the MixWidget configuration file now.<br />\n";

	// call functions to create: conf file, and html file
	makeconf();
	echo "Configuration file complete making html file now<br />\n";
	makehtml();

	function del_zip() {
		global $up_name;
		fclose($up_name);
		unlink($up_name);
	}

	function tryagain()	{
		global $mw_mix_title, $mw_mix_artist, $mw_mix_title_short, $mwbe_tracks_dir, $mwbe_playlist_dir, $mwbe_html_dir, $mwbe_skins_dir, $mw_skin_img, $mw_skin_tx, $mw_skin_ty, $mw_skin_ax, $mw_skin_ay, $mwbe_conf_skel, $html_skel, $mixes_index, $mwbe_cover_img, $mwbe_conf_dir, $mwbe_up_dir;
		echo "Please click the button and try again. If you press back you will have to start all over!\n<br />
	<form action=\"mwbe.php?action=upfiles\" method=\"post\">\n
        <input type=\"hidden\" name=\"mix_title\" value=\"$mw_mix_title\" />\n
        <input type=\"hidden\" name=\"mix_artist\" value=\"$mw_mix_artist\" />\n
        <input type=\"hidden\" name=\"skin_img\" value=\"$mw_skin_img\" />\n
        <input type=\"submit\" value=\"Try Again!\" />\n
        </form>\n";
		exit(0);
	}

}


function makeconf() {
	global $mwbe_server_path, $mwbe_conf_dir, $mw_mix_conf, $mw_mix_artist, $mw_mix_title, $mw_skin_img, $mw_skin_tx, $mw_skin_ty, $mw_skin_ax, $mw_skin_ay;
	// The conf file is all here because this is easier right now...
	// Lots of functionality that's not included in ver 0.1
	$conf_whole = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<widget version=\"2.1\" flashVersion=\"9.0.0\">
	\t<title>$mw_mix_title</title> <!-- shown at opening -->
	\t<creator>$mw_mix_artist</creator><!-- shown at opening -->
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
	\t\t<trackText x=\"$mw_skin_tx\" y=\"$mw_skin_ty\" width=\"260\"></trackText>
    \t\t<artistText x=\"$mw_skin_ax\" y=\"$mw_skin_ay\" width=\"260\"></artistText>
    \t</skin>
    </widget>";
	$ver_conf = $mwbe_server_path . $mw_mix_conf;
	$f_conf = fopen("$ver_conf", "w");
	fwrite($f_conf, $conf_whole);
	fclose($f_conf);

}


function makehtml() {
	global $mwbe_conf_dir, $mwbe_server_path, $mwbe_site_url, $mwbe_up_dir, $mw_mix_title_short, $mw_mix_allow_archive, $mw_mix_allow_embed, $mw_main_swf, $mw_mix_conf, $mw_mix_playlist, $mwbe_skins_dir, $mw_skin_img, $mw_mix_html;
	// This function creates an html file with embed code - if allowed and the track archive link - if allowed
	// and appends an index file that shows all mixes
	// Once again this is easier for this version to have the whole file here.
	// Having problems with variable combining in echo statements. Vars here
	$flash_src = $mwbe_site_url . $mw_main_swf;
	$flash_var_config = $mwbe_site_url . $mwbe_conf_dir . $mw_mix_title_short . ".xml";
	$flash_var_pl = $mwbe_site_url . $mw_mix_playlist;
	$flash_var_skin = $mwbe_site_url . $mwbe_skins_dir . $mw_skin_img;
	if ($mw_mix_allow_archive == "0") {
		$html_archive = "<a href=\"$mwbe_site_url . $mwbe_up_dir . $mw_mix_title_short . '.zip'\">Track Archive</a>";
	} else {
		$$html_archive = "This mix does not have an archive to download";
	}
	if ($mw_mix_allow_embed == "0") {
		$html_embed = "<code>&lt;embed type=\"application/x-shockwave-flash\" width=\"430\" height=\"330\" src=\"$flash_src\" wmode=\"transparent\" flashvars=\"config=$flash_var_config&playlist=$flash_var_pl&skin=$flash_var_skin\"&gt;&lt;/embed&gt;</code>";
	} else {
		$html_embed = "This mix does not allow embeding";
	}
	$mwbe_html_page = "<html>
	<head>\t
	<link type=\"text/css\" rel=\"stylesheet\" href=\"style.css\">\t
	<title>The MixWidget Frontend</title>
	<head>
	<body>\t
	<div id=\"tape\">\t\t
	<embed type=\"application/x-shockwave-flash\" width=\"430\" height=\"330\" src=\"$flash_src\" wmode=\"transparent\" flashvars=\"config=$flash_var_config&playlist=$flash_var_pl&skin=$flash_var_skin\"></embed>\t
	</div>\t
	<div id=\"content\">\t\t
	$html_archive\t
	</div>\t
	<div id=\"embed\">$html_embed</div>
	</body>
	</html>";
	$ver_html = $mwbe_server_path . $mw_mix_html;
	$f_html = fopen("$ver_html", "w");
	fwrite($f_html, $mwbe_html_page);
	fclose($f_html);
	$mwbe_mix_link = $mwbe_site_url . $mw_mix_title_short . ".html";
	$mwbe_mix_list = "echo \"<a href=\\\"$mwbe_mix_link\\\">$mwbe_Mix_Title</a><br />\n";
	$f_includes = fopen("$mwbe_mixes_list", "a");
	fwrite($f_includes, $mwbe_mix_list);
	fclose($f_includes);
}


function validate() {
	echo "<ul id=\"tabmenu\">\n
			<li><a class=\"active\" href=\"mwbe.php?action=validate\">Validate</a>\n
			<li><a href=\"mwbe.php?action=def\">Main</a>\n
			<li><a href=\"mwbe.php?action=makemix\">Make A Mix</a>\n
		</ul>\n
		<div id=\"content\">\n
		<div align=\"center\"><h2>Directory and File Validation</h2></div />\n
		To re-check simply <a href=\"mwbe.php?action=validate\">click here</a> or on the Validate menu option above.<br />\n
		Once everything in both of the lists below is green then <a href=\"mwbe.php?action=\"def\">click here</a> or click Main in the above menu.<br />\n";
	global $mwbe_server_path, $action, $mwbe_dir, $mwbe_playlist_dir, $mwbe_conf_dir, $mwbe_html_dir, $mwbe_skins_dir, $mw_dir, $mw_resources, $mwbe_conf_skel, $mwbe_html_skel, $mwbe_mixes_index, $mwbe_cover_img, $mw_main_swf, $mw_main_ds, $mw_resources_swf, $mw_resources_js, $mw_resources_ds, $mwbe_tracks_dir, $mwbe_up_dir;

	// Some files and dirs need to be writable and some only readable we use two arrays so we don't duplicate work

	$wdir_arr = array($mwbe_playlist_dir, $mwbe_conf_dir, $mwbe_html_dir, $mwbe_mixes_index, $mwbe_tracks_dir, $mwbe_up_dir);
	$rdir_arr = array($mw_dir, $mw_resources, $mwbe_skins_dir, $mw_main_swf, $mw_main_ds, $mw_resources_swf, $mw_resources_js, $mw_resources_ds);

	// Exists and Writable Check

	echo "<div class=\"checks\"><h2>Writable File and Directory Checks</h2 />\n";
	foreach ($wdir_arr as &$wvalue) {
		$wfile_test = $mwbe_server_path . $wvalue;
		if (is_writable($wfile_test)) {
			echo "<text class=\"good\">$wfile_test exists and is writable.</text /><br />\n";
		} elseif (file_exists($wfile_test)) {
			echo "<text class=\"bad\">$wfile_test exists but is not writable.</text /><br />\n";
		} elseif (is_writable($mwbe_dir)) {
			if ($wvalue == $mwbe_mixes_index) {
				fopen ("$mwbe_mixes_index", "w");
			} else {
				mkdir ("$wfile_test", 0775);
			}
			echo "<text class=\"warn\">$wfile_test did not exist but was created for you.</text /><br />\n";
		} else {
			echo "<text class=\"bad\">$wfile_test does not exist and cannot be created for you.</text /><br />\n";
		}
	}
	echo "</div />\n<div class=\"directions\"><p class=\"warn\">The recommended configuration is for the above files and directories to be writable by the user and webserver but not world. How you accomplish this depends on your webhost. However if you have to chmod dirs to 777 and then get hacked don't blame me. If you have a webhost that forces you to use 777 perms to create web writable directories then it's time to find a new one.</p />\n
<p>Any directory or file listed above in <text class=\"good\">green</text /> is configured to allow MixWidget Frontend to work properly but could still have insecure permissions.</p />\n
<p>Any directory or file listed about in <text class=\"warn\">orange</text /> did not exist but has been created for you and has permissions as secure as possible for MixWidget Frontend to work properly</p />\n
<p>And directory or file listed above in <text class=\"bad\">red</text /> either has permissions to restrictive for MixWidget Frontend to work properly or does not exist and cannot be created. In which case you will have to manually set the permissions or in the case of the directory or file not exists re-read the INSTALL document included with MixWidget Frontend.</p />\n
</div />\n";
	echo "<div class=\"checks\"><h2>Readable File and Directory Checks</h2 />\n";

	// Exists and Readable Check
	foreach ($rdir_arr as &$rvalue) {
		$rfile_test = $mwbe_server_path . $rvalue;
		if (file_exists($rfile_test)) {
			echo "<text class=\"good\">$rfile_test exists and is readable.</text /><br />\n";
		} else {
			echo "<text class=\"bad\">$rfile_test does not exist.</text /><br />\n";
		}
	}
	echo "</div />\n<div class=\"directions\"><p class=\"warn\">The checks run on the files above only verify that they exist and can be read by MixWidget Frontend. This does not insure that these files have secure permissions.</p />\n
<p>Any file or directory listed above in <text class=\"good\">green</text /> has at least the minimum permissions necessary for MixWidget Frontent to function properly.</p />\n
<p>Any file or directory listed above in <text class=\"bad\">red</text /> does not exist.</p />\n
<p class=\"warn\">Any missing files or directories in this list will cause MixWidget Frontend not to function properly. Please read the INSTALL document and correct any errors above before attempting to use MixWidget Frontend.</p />\n
</div />\n";
	clearstatcache();

}
?>
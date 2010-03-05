<?php
/*
 * This module provides the functions to define the required parts of a mix
 */

function define_mix(){
	echo "<div id=\"content\">
	<h2>Make a Mix - Choices, choices, choices...</h2>
	Fill in the following information and click the <em>Next Step</em> button:
	<form action=\"index.php?action=upfiles\" method=\"post\">
	Mix Title: <input name=\"mix_title\" value=\"Mix Title\" type=\"text\" /><br />
	Mix Artist: <input name=\"mix_artist\" value=\"Artist\" type=\"test\" /><br />
	Do you wish to link to an archive of the tracks in the mix: Yes <input name=\"mwbe_archive_allow\" type=\"Radio\" value=\"0\" /> No <input name=\"mwbe_archive_allow\" type=\"Radio\" value=\"1\" checked/>(Default: Yes)<br />
	Do you wish to provide code to embed this mix on other sites: Yes <input name=\"mwbe_embed_allow\" type=\"Radio\" value=\"0\" /> No <input name=\"mwbe_embed_allow\" type=\"Radio\" value=\"1\" checked />(Default:Yes)<br />
	Select which skin you want for your mix tape:<br />
	<table border=\"0\" cellpadding=\"1\">\n";
	$skin_count = 1;
	foreach (glob($static_conf->MWBE['SERVER_PATH'] . "/" . $static_conf->MWBE['SKINS_DIR'] . "/*.jpg") as $skin) {
		$skin_img = str_replace($static_conf->MWBE['SERVER_PATH'] . "/" . $static_conf->MWBE['SKINS_DIR'] . "/", '',$skin);
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
	<input type=\"submit\" value=\Next Step\" />\n
	</form>\n
	<br /><br />";
}
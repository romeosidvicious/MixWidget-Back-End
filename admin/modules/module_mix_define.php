<?php
/*
 * This module provides the functions to define the required parts of a mix
 */

class NewMix {

	public function define_mix(){
		global $static_conf;
		echo "<div id=\"content\">
	<h2>Make a Mix - Choices, choices, choices...</h2>
	Fill in the following information and click the <em>Next Step</em> button:
	<form action=\"index.php?action=upfiles\" method=\"post\">
	Mix Title: <input name=\"title\" value=\"Mix Title\" type=\"text\" /><br />
	Mix Artist: <input name=\"artist\" value=\"Artist\" type=\"test\" /><br />
	Do you wish to link to an archive of the tracks in the mix: Yes <input name=\"arch_allow\" type=\"Radio\" value=\"1\" /> No <input name=\"mwbe_archive_allow\" type=\"Radio\" value=\"0\" />(Default: Yes)<br />
	Do you wish to provide code to embed this mix on other sites: Yes <input name=\"emb_allow\" type=\"Radio\" value=\"1\" /> No <input name=\"mwbe_embed_allow\" type=\"Radio\" value=\"0\" />(Default:Yes)<br />
	Select which skin you want for your mix tape:<br />
	<table border=\"0\" cellpadding=\"1\">\n";
		$skin_count = 1;
		foreach (glob($static_conf->SKINS_PATH . "/*.jpg") as $skin) {
			$skin_img = str_replace($static_conf->SKINS_PATH . "/", '',$skin);
			if ($skin_count == 1){
				echo "\t<tr align=\"center\" valign=\"middle\">\n";
			}
			echo "\t\t<td><input name=\"skin\" type=\"Radio\" value=\"$skin_img\"><img align=\"middle\" height=\"64\" width=\"100\" src=\"" . $static_conf->SKINS_URL . $skin_img . "\" /><br />$skin_img</td>\n";
			$skin_count++;
			if ($skin_count == 7) {
				echo "\t</tr>\n";
				$skin_count = 1;
			}

		}
		echo "</table>
	<input type=\"submit\" value=\"Next Step\" />\n
	</form>\n
	<br /><br />";
	}
	
	public function mix_vars(){
		global $static_conf;
		$_SESSION['title'] = $_POST['title'];
		$_SESSION['title_short'] = strtolower(preg_replace("/\W|\s/", "", $_SESSION['title']));
		$_SESSION['artist'] = $_POST['artist'];
		$_SESSION['skin'] = $_POST['skin'];
		$_SESSION['arch_allow'] = $_POST['arch_allow'];
		$_SESSION['emb_allow'] = $_POST['emb_allow'];
	}
}

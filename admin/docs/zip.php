<?php 
echo "<div class=\"popup\">
		<div class=\"popup-header\">
			<h2>Using zip files to make your mix</h2>
			<a href=\"javascript:;\" onclick=\"$.closePopupLayer('zipPopUp')\" title=\"Close\" class=\"close-link\">Close</a>
			<br clear=\both\" />
		</div>
		<div class=\"popup-body\">
			MWBE handles zip files for you to make uploading the tracks for your mixes as easy as possible.<br /> 
			As long as your zip file is created properly MWBE will extract the tracks from it (and cover art if possible) and create your mix with no need for further input from you!<br />
			Your zip file must meet the following standard in order for MWBE to process it correctly:<br />
			<ul>
			<li>Contain no path information: When the files are extracted from the zip they must extract into the directory chosen.</li>
			<li>Cannot be part of a set of zip files.</li>
			</ul>
			Note: Any files that are not proper .mp3 files or proper cover art files will be deleted for security reasons.<br />
			Simply use the upload interface during <em>Make A Mix</em> process and choose a single zip for upload.<br />
			As long as the zip file does not exceed the maximum upload allowed by your server your mix will created for automatically.
		</div>
	</div>";
?>
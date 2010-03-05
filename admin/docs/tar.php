<?php 
echo "<h2>Using tar, tar/gzip. and tar/bzip2 files with MWBE</h2>
In order to use this functionality you must have Archive_Tar, available as a pear module, installed on your system.<br />
";
if (!include('Tar.php')){
	echo "Archive_Tar is not installed on your system, or not accessible to MWBE.<br />
	You will not be able to upload tar files to create your mixes.";
} else {
	echo "Archive_Tar is installed on your system.<br />
	tar files, including tar/gzip and tar/bzip2 can be uploaded through MWBE, or FTP, and will be used to create your mixes.<br />
	As long as your tar file is created properly MWBE will extract the tracks from it (and cover art if possible) and create your mix with no need for further input from you!<br />
	Your zip file must meet the following standard in order for MWBE to process it correctly:<br />
	<ul>
	<li>Contain no path information: When the files are extracted from the tar they must extract into the directory chosen without creating subdirectories.</li>
	<li>Be either a standard tar file, tar/gzip, or tar/bzip2 file.</li>
	<ul>
	Note: Any files that are not proper .mp3 files or proper cover art files will be deleted for security reasons.<br />
	Simply use the upload interface during <em>Make A Mix</em> process and choose a single zip for upload.<br />
	As long as the tar file does not exceed the maximum upload allowed by your server your mix will created for automatically.";
}
?>
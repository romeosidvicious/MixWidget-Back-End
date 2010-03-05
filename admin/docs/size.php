<?php 
echo "Your server can handle uploads up to: ". ini_get('upload_max_filesize') . " in size.<br />
If you attempt to upload a larger file than this your upload will fail.<br />
If you need to upload larger files please look at the ftp upload options offered by MWBE.<br />
";
?>
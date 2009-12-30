<?php
echo "<html>
<head>
\t<link type=\"text/css\" rel=\"stylesheet\" href=\"includes/style.css\">
\t<title>Your Mixes</title>
<head>
<body>
\t<div>
\t\t<h2>The Mix Widget Back End V1.0 beta 1</h2>
\t\t<h3>For your listening pleasure:</h3>
";

echo "$includes_dir<br />\n";
foreach(glob("mixes/*.include") as $mix_include) {
	include "$mix_include";
}

echo "</body>
</html>";

?>
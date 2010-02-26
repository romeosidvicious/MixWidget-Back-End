<?php
session_start();
/* MixWidget Backend (MWBE)
 * An interface for the mixwidget mp3 player
 * Ver: 1.0 beta 2
 * 
 * Code by: Romeo Sid Vicious
 * License: GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 * This is my first real php script so this code will probably look horrible and change daily.
 */

require "includes/mwbe_conf.php";
require "includes/functions.php";
require "includes/getid3/getid3.php";
include "includes/header.php";
nav();
include "includes/footer.php";
?>
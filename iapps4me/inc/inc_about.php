<?php

// Get template
$myFile = "about.html";
$fh = fopen($myFile, 'r');
$content = fread($fh, filesize($myFile));
fclose($fh);

?>

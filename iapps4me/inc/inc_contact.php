<?php

// Get template
$myFile = "contact.html";
$fh = fopen($myFile, 'r');
$content = fread($fh, filesize($myFile));
fclose($fh);

?>

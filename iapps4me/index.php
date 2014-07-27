<?php

// Connect
include_once('config.php');
include_once('class.phpmailer.php');

// Get template
$myFile = "template.html";
$fh = fopen($myFile, 'r');
$template = fread($fh, filesize($myFile));
fclose($fh);

$content = '';
$heading = '';

@$c = $_GET['c'];
@$a = $_GET['a'];

if ($c == 'solve') 
{
    include_once('inc/inc_solve.php');
}
elseif ($c == 'idea')
{
  include_once('inc/inc_idea.php');
}
elseif ($c == 'idea-add')
{
  include_once('inc/inc_idea-add.php');
}
elseif ($c == 'about')
{
  include_once('inc/inc_about.php');
}
elseif ($c == 'contact')
{
  include_once('inc/inc_contact.php');
}
else
{
  // Default page
  include_once('inc/inc_home.php');
}

// Place content into template
$template = str_replace('##_HEADING_##', $heading, $template);
$template = str_replace('##_CONTENT_##', $content, $template);

echo $template;

?>

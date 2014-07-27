<?php

/***************************************************************************
 * nx2 index.php
 ***************************************************************************/

// record page render time
$starttime = microtime();
$startarray = explode(" ", $starttime);
$starttime = $startarray[1] + $startarray[0];

// include classes & config
include 'config.php';
include 'classes/class_mysql_record.php';
include 'classes/class_mysql_multi_record.php';
include 'classes/class_func.php';

// include content classes
include 'content/class_georgeopedia.php';

/******************************************************************************/
// Beginning of code
/******************************************************************************/

  // Set content expiry to prevent proxies from caching the page
  header("Cache-Control: no-cache");
  $offset = 60 * 60 * 24 * -1;
  $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
  header($ExpStr);

  if ($_GET['c'] != '')
  {
    $content = $_GET['c'];
  }

  // protect against possibly harmful parameters
  func_check_parameter($content);

  if ($content == "")
  {
    // set default page if no page is specified
    $content = "georgeopedia";
  }

  // setup connection to database
  $dbconn = set_config();

  if ($content == 'georgeopedia')
  {
    $obj_georgeopedia = new content_georgeopedia();
    $page_content = $obj_georgeopedia->content($dbconn);
  }
  else
  {
    $page_content = 'Content page not found!';
    define("page_heading", "Fatal Error");
    $content = 'denied';
  }

  if ($content != 'denied' && !defined("page_heading"))
  {
    $page_content = 'Cannot load specified action page!';
    define("page_heading", "Fatal Error");
    $content = 'denied';
  }

  // Import HTML skin
  $layoutfile = './skin.html';

  if (!file_exists($layoutfile))
  {
    die ("Invalid skin was selected or it could not be found (heaven forbid!)");
  }
  else
  {
    $fp = fopen($layoutfile,"r");
    $layout = fread($fp, constant("LAYOUT_MAX_BYTES"));
    fclose($fp);
  }

  $layout = str_replace("#>_CONTENT_<#", $page_content, $layout);
  $layout = str_replace("#>_TITLE_<#", $content, $layout);
  $layout = str_replace("#>_LATEST_SEARCHES_<#", get_latest_searches($dbconn), $layout);
  $layout = str_replace("#>_RANDOM_SEARCHES_<#", get_random_searches($dbconn), $layout);
  $layout = str_replace("#>_FACT_COUNT_<#", get_fact_count($dbconn), $layout);
  $layout = str_replace("#>_HEADING_<#", constant("page_heading"), $layout);

  // Display the layout with content et al inserted to the browser:
  echo $layout;

  // Display debug info if the content time is text/html
  $endtime = microtime();
  $endarray = explode(" ", $endtime);
  $endtime = $endarray[1] + $endarray[0];
  $totaltime = $endtime - $starttime;
  $totaltime = round($totaltime,5);
  echo "\n<!-- nx2 CMS\nThis page loaded in $totaltime seconds.-->";

?>

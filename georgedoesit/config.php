<?php

function set_config()
{
  $dbhost = "127.0.0.1";
  $dbname = "changeme";
  $dbuser = "changeme";
  $dbpasswd = "changeme";

  define("LAYOUT_MAX_BYTES", "300000");
  
  // Connect to the database:
  $dbcnx = mysqli_connect($dbhost, $dbuser, $dbpasswd, $dbname);
  if ( !$dbcnx ) {
    echo( "<p>FATAL ERROR: Unable to connect to the " .
          "database server '$dbhost' at this time.</p>" );
    exit();
  }

  /* check connection */
  if (mysqli_connect_errno()) {
    die("Connect failed: " . mysqli_connect_error());
  }

  return $dbcnx;
}

function set_cookie($cookiename, $data, $time)
{
  // sets a cookie, change the params in here when moving to another webserver
  setcookie($cookiename, $data, $time);
}

?>
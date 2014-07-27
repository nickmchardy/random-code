<?php

/* 301 Redirector

 26-Aug-2010
 N. McHardy
 www.nickmchardy.com
 
 
To be used in conjuction with .htaccess file with the following content:

RewriteEngine on
RewriteRule ^(.+)/?$ index.php?/$1/ [L]


Also to be used with a file called redirect_rules.csv in the same directory with the following format:
sourceurl,targeturl

*/

// Obtain requested page
$requested_page = $_SERVER['REDIRECT_QUERY_STRING'];

// Default Page - change this to the default page if no matching URL could be found
$default_page = 'http://www.curves.com.au/';

// Base URL - change this to form the base URL for all generated links
$base_url = 'http://www.curves.com.au/';

// Lookup rules - load from redirect_rules.csv
$rule = array();
if (($handle = @fopen("redirect_rules.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
        $rule[$data[0]] = $base_url . $data[1];
    }
    fclose($handle);
}
else
{
  // Something bad happened, we will redirect to the default URL silently:
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: " . $default_page);
}

// Redirect user based on rules using 301 (search engine friendly)
$target_url = $rule[$requested_page];
if ($target_url == '')
{
  // Could not find url in rules, defaulting to default URL
  $target_url = $default_page;
}
header("HTTP/1.1 301 Moved Permanently");
header("Location: " . $target_url); 

?>
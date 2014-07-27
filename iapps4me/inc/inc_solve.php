<?php

include_once 'util.php';

$hash = $_GET['h'];
$sql = "UPDATE solutions s SET s.approved=1 WHERE s.hash='" . $hash . "'";

if ( @mysql_query ( $sql )  )
{
  $sql = "SELECT * FROM solutions WHERE hash='" . $hash . "'";
  $query = @mysql_query($sql);
  $row = mysql_fetch_assoc ( $query );
  $id = $row['id'];
  $solution = $row['solution'];
  $content = "Solution confirmed! view it <a href='./?c=idea&id=" . $id . "'>here</.a>";

  $sql = "SELECT * FROM ideas WHERE id=" . $id;
  $query = @mysql_query($sql);
  $row = mysql_fetch_assoc ( $query );
  $title = $row['title'];
  $description = $row['description'];
  
  $from = "info@iapps4.me";
  $subject = "There is a new solution for an issue that you follow";
  $message = 
"Hello,

A new solution has been posted for the following problem:

" . $title . "

" . $description . "

SOLUTION:

". $solution . "

Thanks,

iapps4.me

";
  
  $sql = "SELECT email FROM iprovider WHERE id=" . $id;
  $query = @mysql_query($sql);
  while ($row = mysql_fetch_assoc( $query ))
  {
      sendemail($row['email'], 'info@iapps4.me', 'A solution has been posted', $message);
  }
}
else
{
  $content = "Oh no, there was a database error when trying to process that solution.";
}


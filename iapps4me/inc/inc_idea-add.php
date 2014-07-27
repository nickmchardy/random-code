<?php

include_once 'util.php';

$heading = 'Add New Idea';
$content = '';

if ($a == 'add')
{
  // Validate input
  if ($_POST['email'] == '' || $_POST['description'] == '' || $_POST['title'] == '')
  {
    $content .= "I'm sorry, you need to enter email, title and description!";
  }
  elseif (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
  {
    $content .= "I'm sorry, you need to enter a valid email address!";
  }
  else
  {
    // Perform DB insert
    $sql = "INSERT INTO ideas (email, description, title, likes) VALUES ('" . $_POST['email'] . "','" . $_POST['description'] . "', '" . $_POST['title'] ."', 0)";

    if ( @mysql_query ( $sql )  )
    {
      $content .= "Your idea has been submitted! <a href='./?c=idea&id=" . mysql_insert_id () . "'>Continue</.a>";
    }
    else
    {
      $content .= "Oh no, there was a database error when trying to add your idea. (" . $sql . ")";
    }

  }
}
else
{
  $content .= '<div id="form">';
  $content .= '<form action="./?c=idea-add&a=add" method="POST">';
  $content .= '<div><label for="email">Email:</label><input name="email" maxlength="100"/></div>';
  $content .= '<div><label for="title">Title:</label><input name="title" maxlength="100"/></div>';
  $content .= '<div><label for="description">Description:</label><textarea name="description" cols="50" rows="5"></textarea></div>';
  $content .= '<input type="submit" value="Add Idea"/>';
  $content .= '</form>';
  $content .= '</div>';
}

?>

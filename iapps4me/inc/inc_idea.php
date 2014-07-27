<?php

include_once 'util.php';

$heading = "Idea Detail";
$content = "";

if ($a =='like')
{
  if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
  {
    $content .= "I'm sorry, you need to enter a valid email address!";
  }
  else 
  {
      $id = $_POST['id'];
      $sql = 'INSERT INTO iprovider (email, id, price)  VALUES ("' . $_POST['email'] . '", ' . $id . ',' . $_POST['price'] . ')';
      @mysql_query ($sql);
      
      $sql = "UPDATE ideas i SET i.likes =  i.likes + 1 WHERE i.id = " . $id;
      @mysql_query ($sql);
      
      $content .= "You will now be updated when confirmed solutions are provided for this idea. <a href='./?c=idea&id=" . $id . "'>Continue.</a>";
  }
}

elseif ($a == 'add-solution')
{
  // Validate input
  if ($_POST['email'] == '' || $_POST['description'] == '')
  {
    $content .= "I'm sorry, you need to enter email and description!";
  }
  elseif (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
  {
    $content .= "I'm sorry, you need to enter a valid email address!";
  }
  else
  {
    // Perform DB insert

    $sql = "INSERT INTO sprovider (email) VALUES ('" . $_POST['email'] . "')";
    @mysql_query ($sql);
    $spid = mysql_insert_id();
    $hash = new_hash();
    $sql = "INSERT INTO solutions (solution, id, spid, hash) VALUES ('" 
      . $_POST['description'] . "', " . $_POST['id'] . ", " . $spid . ", '" . $hash . "')";

    if ( @mysql_query ( $sql )  )
    {
      $content .= "Your solution has been submitted! <a href='./?c=idea&id=" . $_POST['id'] . "'>Continue</.a>";
      
      $sql = "SELECT * FROM ideas i WHERE i.id=" . $_POST['id'];
      if(@mysql_query($sql))
      {
          $query = mysql_query ( $sql );
          $row = mysql_fetch_assoc ( $query );
          $to = $row['email'];
          $title = $row['title'];
          $description = $row['description'];
          
          $message = 
"Hello,

A solution to your idea has been posted to your idea:

" . $title . "

" . $description . "

If this solution solves your problem, then click on the link below and it will get added to the site as a confirmed solution:

http://iapps4.me/index?c=solve&h=" . $hash . "

Thanks for your help,

iapps4.me

";
          sendemail($to, 'info@iapps4.me', 'A solution to your idea ('. $title . ') has been posted at iapps4.me', $message);
      }
    }
    else
    {
      $content .= "Oh no, there was a database error when trying to add your solution.";
    }
  }

}
else
{

  // Show Idea

       $sql = "SELECT * FROM ideas i WHERE i.id = " . $_GET['id'];

        if ( @mysql_query ( $sql ) )
        {
                $query = mysql_query ( $sql );
                $row = mysql_fetch_assoc ( $query );

                do {
                        $content .= '        <div id="details">';
                        $content .= '<div class="title">';
                        $content .= '<h2>' . str_replace('<', '&lt;', str_replace('>', '&gt;', $row['title'])) . '&nbsp;</h2>';
                        $content .= '<span>' . $row['likes'] . ' people liked this idea</span>';
                        $content .= '</div>';
                        $content .= '<img src="images/listing_highlight.png" />';
                        $content .= '<p>' . str_replace('<', '&lt;', str_replace('>', '&gt;', $row['description'])) . '</p>';

                        // Get average price
                        //$sql2 = "SELECT AVG(price) AS avg_price FROM iprovider i WHERE i.id = " . $_GET['id'];
                        //$query2 = mysql_query ( $sql2 );
                        //$row2 = mysql_fetch_assoc ( $query2 );
                        //$content .= '<p>Price: $' . number_format($row2['avg_price'], 2) . '</p>';

                        $content .= '<div id="like_form">'; 
                        $content .= '<form action="./?c=idea&a=like" method="POST">';
                        $content .= 'Email: <input name="email" maxlength="100"/>';
                        $content .= '<input type="hidden" name="id" value="' . $_GET['id'] . '"/>';
                        $content .= '<br/>Price: &nbsp;<input name="price" size="3"/> ';
                        $content .= '<input type="submit" value="Like"/>';
                        $content .= '</form></div>';
                        $content .= '            <img src="images/line.png" />';
                        $content .= '        </div>';

                } while ( $row = mysql_fetch_assoc ( $query ) );
        }
        else {
                die ( mysql_error () );
        }

  // Show Solutions (if available)

  $content .= '<h1>Solutions</h1>';

       $sql = "SELECT * FROM solutions s JOIN sprovider sp ON s.spid = sp.spid WHERE s.approved=1 AND s.id = " . $_GET['id'];

        if ( @mysql_query ( $sql ) )
        {
                $query = mysql_query ( $sql );
                $row = mysql_fetch_assoc ( $query );

                if ($row['sid'] == '')
                {
                   $content .= '<p>No solutions were found - be the first and submit one below!</p>';
                }
                else
                {
                   $i = 1;
                   do {

                        $content .= '        <div id="details">';
                        $content .= '                <h2>Solution #' . $i . '</h2>';
                        $content .= '                <span>Solution Provider: ' . $row['email'] . '</span>';
                        $content .= '                <img src="images/line.png" />';
                        $content .= '                <p>' . $row['solution'] . '</p>'; 
                        $content .= '            <img src="images/line.png" />';
                        $content .= '        </div>';
                        $i++;
                   } while ( $row = mysql_fetch_assoc ( $query ) );
                }
        }
        else {
                die ( mysql_error () );
        }


  // Add Solution

  $content .= '<div id="form">';
  $content .= '<h1>Add new solution</h1>';

  $content .= '<form action="./?c=idea&a=add-solution" method="POST">';
  $content .= '<div><label for="email">Your email: </label><input name="email" maxlength="100"/></div>';
  $content .= '<div><label for="description">Solution: </label><textarea name="description" cols="50" rows="5"></textarea></div>';
  $content .= '<div><input type="submit" value="Submit Solution"/></div>';
  $content .= '<input type="hidden" name="id" value="' . $_GET['id'] . '"/>';
  $content .= '</form>';
  $content .= '</div>';
  }

?>

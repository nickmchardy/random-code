<?php

/***************************************************************************
 *                             ds/class_func.php
 *                            --------------------
 *   begin                : 5 June 2004
 *   copyright            : (C) 2004 N. McHardy
 *   email                : admin@nisch.org
 *
 *   desc:
 * class for cool 'n' handy functions, although I guess it's not really a 'class'...
 *
 ***************************************************************************/

  function date_format2($datestamp)
  {
    $tzoffset = 0;
    if ($datestamp == "0000-00-00") {
      $datestamp = "0000-00-00 00:00:00";
    }
    list($date,$time) = explode(" ",$datestamp);
    list($year,$month,$day) = explode("-",$date);
    list($hour,$minute,$second) = explode(":",$time);
    $hour = $hour + $tzoffset;
    $tstamp = mktime($hour,$minute,$second,$month,$day,$year);
    $sDate = date("l jS \\o\f F Y \\a\\t g:i a \\A\E\S\T",$tstamp); //aussie format... much better!
    return $sDate;
  }
  
  function get_file_date($filename)
  {
    // open a file
    if (!@$fp = fopen($filename, "r"))
    {
      return 0;	
    }

    // gather statistics
    $fstat = fstat($fp);

    // close the file
    fclose($fp);

    // print only the associative part
    //print_r(array_slice($fstat, 13));
    
    return $fstat['mtime'];
  }
  
  function stop_spam($email)
  {
    return ereg_replace("@", '-at-', $email);
  }
  
  function no_login_error()
  {
     return 'Sorry, you must be logged in to view this page.<br><br>' . no_login_options();
  }

  function no_login_options()
  {
    $target = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'] ;

    return '
    <ul>
    <li><a href=./?c=login&target=' . urlencode($target) . '>Log me in now!</a></li>
    <li>I don\'t have an account, <a href=./?c=register>create one now</a> - it doesn\'t take long!</li>
    <li><a href=./?c=register&action=why>Why should I create an account?</a></li>
    </ul>
    ';
  }

  function get_logout()
  {
    return 'Currently logged in as ' . $_COOKIE['nx_username'] . ' - [<a href=./?c=login&action=logout>logout</a>]';
  }

  function get_latest_blogs()
  {
    $result = mysql_query("SELECT * FROM " . constant("table_prefix") . "blog ORDER BY date DESC, time DESC LIMIT 5");
    if (!$result) {
        echo("<p>Error performing query: " . mysql_error() . "</p>");
        exit();
    }
    // Display the links...
    $i = 0;
    while (($row = mysql_fetch_array($result)))
    {
        $i++;
        $menu_text .= '- ';
        $menu_text .= "<a href=./?c=blog#" . $i . ">'" . $row["title"] . "'</a><br>";
    } //while
    return $menu_text;
  }


  function func_auth($username, $password)
  {
     $obj_user = new mysql_record(constant("table_prefix"), 'users',
       "WHERE username = '" . $username . "' AND password = '" . $password . "'");

     if ($obj_user->field('username') != '')
     {
       // save cookies
       func_save_cookies($username, $password);
       // update last active date
       func_update_last_active($obj_user);
       return $obj_user->field('user_id');
     }
     else
     {
       return false;
     }
  }

  function fix_slashes($input)
  {
    return stripslashes(str_replace("\\", '\\\\', $input));
  }

  function format_price($price)
  {
    // formats a price to a nice clean $10.00 style format
    return '$' . number_format($price, 2, '.', '');
  }

  function func_format_date($unix_timestamp)
  {
    return date("Y-m-d H:i:s", $unix_timestamp);
  }

  function func_save_cookies($username, $password)
  {
    $time = 3600;
    $rem = '';

    if ($_POST['remember'] == 'on')
    {
      $rem = 'on';
      $time = 31536000;  // 1 year!
    }
    else if ($_COOKIE['nx_remember'] == 'on')
    {
      $rem = 'on';
      $time = 31536000;  // 1 year!
    }

    setcookie('nx_username', $username, time() + $time);
    setcookie('nx_password', $password, time() + $time);
    setcookie('nx_remember', $rem, time() + $time);
  }

  function func_update_last_active($obj_user)
  {
    $obj_user->fields['last_active'] = func_format_date(time());
    $obj_user->update_database();
  }

  function func_clear_cookies()
  {
    setcookie('nx_username', '', time() - 3600);
    setcookie('nx_password', '', time() - 3600);
    setcookie('nx_skin', '', time() - 3600);
    setcookie('nx_remember', '', time() - 3600);
  }

  function func_check_parameter($param)
  {
    if (strlen(strstr($param, '/')))
    {
      die ("FATAL ERROR: Invalid content parameter!");
    }

    if (strlen(strstr($param, '.')))
    {
      die ("FATAL ERROR: Invalid content parameter!");
    }

    if (strlen(strstr($param, '%')))
    {
      die ("FATAL ERROR: Invalid content parameter!");
    }
  }

  function func_news($number_of_posts)
  {
    // gets the latest news and displays it in an html table.
    // $number_of_posts = how many of the newest news posts to display

    $obj_news = new mysql_multi_record(constant("table_prefix"), 'news',
       " ORDER BY datetime DESC LIMIT " . $number_of_posts);

    $page_content .= '';

    foreach ($obj_news->fields as $record)
    {
      $page_content .=
      '<table width=90% border=1>
      <tr><td>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td class="status" width=70%>"' . $record['title'] . '"</td>
          <td class="status" width=30%>Posted at: ' . func_format_date($record['datetime']) . '</td>
        </tr>
        <tr>
          <td colspan="2">' . $record['post'] . '</td>
        </tr>
        <tr>
          <td colspan="2" class="status">~ ' . $record['author'] . '</td>
        </tr>
      </table>
      </td></tr></table><br>
      ';
    }
    
    return $page_content;
  }
  
  function get_username($user_id)
  {
    $obj_user = new mysql_record(constant("table_prefix"), 'users',
      "WHERE user_id = " . $user_id . "");

    if ($obj_user != null)
    {
       return "<a href=./?c=profile&action=view&user_id=" . $user_id . ">" . $obj_user->fields['name'] . "</a>";
    }
    else
    {
      return 'Unknown User';
    }
  }

  function get_account($user_id)
  {
    $obj_user = new mysql_record(constant("table_prefix"), 'users',
      "WHERE user_id = " . $user_id . "");

    if ($obj_user != null)
    {
       return $obj_user;
    }
    else
    {
      return null;
    }
  }

  function do_smilies($text)
  {
      $obj_smilies = new mysql_multi_record(constant("table_prefix"), 'smilies', "");

      $targets = array();
      $urls = array();

      foreach ($obj_smilies->fields as $record)
      {
        $targets[] = $record['target'];
        $urls[] = '<img align=absmiddle src=' . $record['url'] . '>';
      }

      $text = str_replace($targets, $urls, $text);

      return $text;
  }
  
  function get_num_blog_comments($blog_id)
  {
    $obj_comments = new mysql_multi_record(constant("table_prefix"), 'blog_comments',
     " WHERE blog_id = " . $blog_id);

    return $obj_comments->count_records();
  }

  function get_num_photo_comments($picid)
  {
    $obj_comments = new mysql_multi_record(constant("table_prefix"), 'photos_comments',
     " WHERE picid = " . $picid);
     
    return $obj_comments->count_records();
  }

  function func_protect_post()
  {
    // check if a form has been post'ed that it came from this server!

    $good_string = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $target = $_SERVER['HTTP_REFERER'];
    
    $referer_ok = (substr($target, 0, strlen($good_string)) == $good_string);

    if (!$referer_ok && count($_POST))
    {
      die ("Form submitted from a different server!");
    }

  }

  function func_menu($obj_user)
  {
    $obj_menu = new mysql_multi_record(constant("table_prefix"), 'menu',
       " ORDER BY menu");

    $page_content .= '';

    foreach ($obj_menu->fields as $record)
    {
      if (!($obj_user != null && $record['remove_if_logged'] == 1))
        $page_content .= "- <a href=" . $record['link'] . ">" . $record['menu'] . "</a><br>\n";
    }
    if ($obj_user->fields['priv'] == 'admin')
    {
      $page_content .= '- <a href=./?c=admin>admin</a>';
    }

    return $page_content;
  }

  function func_menu_bar($obj_user)
  {
    // gets the menu items but displays them in one line or "menu bar"

    $obj_menu = new mysql_multi_record(constant("table_prefix"), 'menu',
       " ORDER BY menu");

    $page_content .= '';

    foreach ($obj_menu->fields as $record)
    {
      if (!($obj_user != null && $record['remove_if_logged'] == 1))
        $page_content .= "- <a href=" . $record['link'] . ">" . $record['menu'] . "</a> ";
    }

    // using substr to remove the first "- " from the menu cos it looks ugly!
    return substr($page_content, 2, strlen($page_content));
  }

  function func_random_pic()
  {
    // gets a random photo and displays it as a thumbnail
    $obj_forms = new html_form();

    $obj_pic = new mysql_multi_record(constant("table_prefix"), 'photos',
       " ORDER BY RAND() LIMIT 1");

    foreach ($obj_pic->fields as $record)
    {
      $page_content .= '<a href=./?c=photos&picid=' . $record['picid'] . '><center><img src=classes/class_thumbnail.php?pic=../' . $record['url'] . 
'&width=130></center></a>';
    }

    return $page_content;
  }

  function get_skin($skin_id)
  {
    // gets a skin's record

    $obj_skin = new mysql_record(constant("table_prefix"), 'skins', "WHERE skin_id = '" . $skin_id . "'");

    if ($obj_skin->fields['skin_id'] == "")
      return null;

    return $obj_skin;
  }

  function skin_selector($skin_highlight)
  {
    // grab skins out of the db
    $obj_skins = new mysql_multi_record(constant("table_prefix"), 'skins', "");

    foreach ($obj_skins->fields as $record)
    {
      $sel = "";
      if ($_GET['s'] == "" && $skin_highlight == $record['skin_id'])
      {
        $sel = " <<<";
      }
      else if ($_GET['s'] == $record['skin_id'])
      {
        $sel = " <<<";
      }
      
      $link = "./?";

      foreach ($_GET as $get => $data)
      {
      	if ($get != 's')
          $link .= "$get=$data&";
      }

      $selection .= "- <a href=" . $link . "s=" . $record['skin_id'] . ">" . $record['skin_title'] . "</a> $sel<br>\n";
    }

    return $selection;
  }

  function save_skin($skin_id, $obj_user)
  {
    $obj_user->fields['skin'] = $skin_id;

    $obj_user->update_database();
  }
  
/*******************************************************************************************************/

function htmlwrap($str, $width = 60, $break = "\n", $nobreak = "", $nobr = "pre", $utf = false) {

  // Split HTML content into an array delimited by < and >
  // The flags save the delimeters and remove empty variables
  $content = preg_split("/([<>])/", $str, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

  // Transform protected element lists into arrays
  $nobreak = explode(" ", $nobreak);
  $nobr = explode(" ", $nobr);

  // Variable setup
  $intag = false;
  $innbk = array();
  $innbr = array();
  $drain = "";
  $utf = ($utf) ? "u" : "";

  // List of characters it is "safe" to insert line-breaks at
  // Do not add ampersand (&) as it will mess up HTML Entities
  // It is not necessary to add < and >
  $lbrks = "/?!%)-}]\\\"':;";

  // We use \r for adding <br /> in the right spots so just switch to \n
  if ($break == "\r") $break = "\n";

  while (list(, $value) = each($content)) {
    switch ($value) {

      // If a < is encountered, set the "in-tag" flag
      case "<": $intag = true; break;

      // If a > is encountered, remove the flag
      case ">": $intag = false; break;

      default:

        // If we are currently within a tag...
        if ($intag) {

          // If the first character is not a / then this is an opening tag
          if ($value{0} != "/") {

            // Collect the tag name   
            preg_match("/^(.*?)(\s|$)/$utf", $value, $t);

            // If this is a protected element, activate the associated protection flag
            if ((!count($innbk) && in_array($t[1], $nobreak)) || in_array($t[1], $innbk)) $innbk[] = $t[1];
            if ((!count($innbr) && in_array($t[1], $nobr)) || in_array($t[1], $innbr)) $innbr[] = $t[1];

          // Otherwise this is a closing tag
          } else {

            // If this is a closing tag for a protected element, unset the flag
            if (in_array(substr($value, 1), $innbk)) unset($innbk[count($innbk)]);
            if (in_array(substr($value, 1), $innbr)) unset($innbr[count($innbr)]);
          }

        // Else if we're outside any tags...
        } else if ($value) {

          // If unprotected, remove all existing \r, replace all existing \n with \r
          if (!count($innbr)) $value = str_replace("\n", "\r", str_replace("\r", "", $value));

          // If unprotected, enter the line-break loop
          if (!count($innbk)) {
            do {
              $store = $value;

              // Find the first stretch of characters over the $width limit
              if (preg_match("/^(.*?\s|^)(([^\s&]|&(\w{2,5}|#\d{2,4});){".$width."})(?!(".preg_quote($break, "/")."|\s))(.*)$/s$utf", $value, $match)) 
{

                // Determine the last "safe line-break" character within this match
                for ($x = 0, $ledge = 0; $x < strlen($lbrks); $x++) $ledge = max($ledge, strrpos($match[2], $lbrks{$x}));
                if (!$ledge) $ledge = strlen($match[2]) - 1;

                // Insert the modified string
                $value = $match[1].substr($match[2], 0, $ledge + 1).$break.substr($match[2], $ledge + 1).$match[6];
              }

            // Loop while overlimit strings are still being found
            } while ($store != $value);
          }

          // If unprotected, replace all \r with <br />\n to finish
          if (!count($innbr)) $value = str_replace("\r", "<br />\n", $value);
        }
    }

    // Send the modified segment down the drain
    $drain .= $value;
  }

  // Return contents of the drain
  return $drain;
}

/*******************************************************************************************************/
  
  
  
  
  

function get_yell_box($obj_user)
{
  $result = mysql_query("SELECT * FROM " . constant("table_prefix") . "yell ORDER BY date");
    if (!$result) {
      echo("<p>Error performing query: " . mysql_error() . "</p>");
      exit();
    }

  $num_rows = mysql_num_rows($result);

  $x = 0;
  while ($row = mysql_fetch_array($result))
  {
      if($x > $num_rows - 15)
      {

        $name = $row['name'];
        
        if ($row['user_id'] != 0)
        {
          $name = get_username($row['user_id']);
        }

          if ($x == $num_rows - 1)
          {
            $page_content .= "<br><font size=2><b>" . $name . "</b>: ";
            $page_content .= htmlwrap($row["comment"], 16, " ") . "<br></font>";
          }
          else
          {
            $page_content .= "<font size=1><b>" . $name . "</b>: ";
            $page_content .=  htmlwrap($row["comment"], 16, " ") . "<br></font>";
          }
     }
     $x++;
  }

  $page_content .= "<br><a href=./?c=yell>View Full History</a>";
  $page_content .= "<br><a href=./?c=smilies>View Smilies</a><br>";

  $page_content .= "<hr width=70%>";
  $page_content .= "<p><font size=2><b>Yell:</b><br><FORM ACTION='./?c=yell&action=submit' METHOD=POST>";
  $page_content .= "<table class=mini><tr><td>Name:</td><td>";
  if ($obj_user == null)
  {
    $page_content .= "<INPUT TYPE=text NAME=name SIZE=5 maxlength=20>";
  }
  else
  {
    $page_content .= "<INPUT TYPE=hidden NAME=name value='" . $obj_user->fields["name"] . "'> " . $obj_user->fields["name"];
  }
  $page_content .= "</td></tr>";
  $page_content .= "<tr><td>Msg:</td><td><input type=text name=comments size=10 maxlength=100></td></tr>";
  $page_content .= "<tr><td colspan=2>Enter <b>" . constant("antispamkey") . "</b> below:</td></tr><tr><td>&nbsp;</td><td><input size=6 maxlength=6 
name=key></td></tr>";
  $page_content .= "<tr><td>&nbsp;</td><td><INPUT TYPE=submit NAME=gb VALUE=Yell>
  <input type=hidden name=target value=http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'] . ">
  </td></tr>";

  $page_content .= "</table></FORM></p></font>";

  return $page_content;

}

  function protect_get()
  {
    foreach($_GET as $get => $data)
    {
      $_GET[$get] = addslashes($data);
    }
  }
   
  function process_post_field($field)
  {
    // removes html etc. and adds in new lines for posts

    $field = str_replace(">", "&gt;", $field);
    $field = str_replace("<", "&lt;", $field);
    $field = ereg_replace("\n","<br>",$field);

    return $field;
  }

  function mysql_to_date($mysql_date)
  {
    return date("d-m-Y", strtotime($mysql_date));
  }

  function time_difference($early_time, $late_time, $seconds)
  {
    return ($early_time - $late_time) < $seconds;
  }

  function get_admin_menu_link()
  {
     return '- <a href=./?c=admin>Return to the Admin Main Menu</a>';
  }


  function get_latest_searches($dbconn)
  {
    $statement = $dbconn->prepare('SELECT message FROM log WHERE type = "search" ORDER BY id DESC LIMIT 0,10');
    $statement->execute();
    $statement->bind_result($message);
    $message = stripslashes($message);

    $pagecontent .= '<ul>';

    while ($statement->fetch())
    {
      $page_content .=  '<li><a href="./?c=georgeopedia&action=query&question='
                        . $message . '">' . $message . '</a></li>';
    }

    $pagecontent .= '</ul>';

    return $page_content;
  }

  function get_random_searches($dbconn)
  {
    $statement = $dbconn->prepare('SELECT lookup FROM facts ORDER BY RAND() LIMIT 0,5');
    $statement->execute();
    $statement->bind_result($message);
    $message = stripslashes($message);

    $pagecontent .= '<ul>';

    while ($statement->fetch())
    {
      $page_content .=  '<li><a href="./?c=georgeopedia&action=query&question='
                        . $message . '">' . $message . '</a></li>';
    }

    $pagecontent .= '</ul>';

    return $page_content;
  }

  function get_fact_count($dbconn)
  {
      $statement = $dbconn->prepare("SELECT COUNT(1) FROM facts LIMIT 0,1");
      $statement->execute();
      $statement->bind_result($count);
      $statement->fetch();

      return 'I know ' . $count . ' facts more than you mate.';
  }

?>

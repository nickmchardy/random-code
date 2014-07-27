<?php

/***************************************************************************
 * Georgeopedia!
 ***************************************************************************/


class content_georgeopedia
{
  function content($dbconn)
  {
    if ($_GET['action'] == '')
    {
      define("page_heading", "Georgeopedia");
      return $this->action_default($dbconn);
    }
    else if ($_GET['action'] == 'query')
    {
      define("page_heading", "Georgeopedia");
      return $this->action_query($dbconn, $_GET['question']);
    }
    else if ($_GET['action'] == 'add')
    {
      define("page_heading", "Georgeopedia");
      return $this->action_add($dbconn, $_POST['lookup'], $_POST['fact']);
    }
  }

  function action_default($dbconn)
  {
    $page_content = 'Ask me something. Go on. Do it. Do it.';

    return $page_content;
  }

  function action_query($dbconn, $question)
  {
    if ($question != '')
    {
      $question = strtolower(stripslashes($question));

      $statement = $dbconn->prepare("SELECT lookup, fact FROM facts WHERE lookup = ? LIMIT 0,1");
      $statement->bind_param("s", $question);
      $statement->execute();
      $statement->bind_result($lookup, $fact);
      $statement->fetch();

      if ($fact == '')
      {
        $page_content = strip_tags(trim($question)) . '? Dunno mate... Add it to my Knowledge.';
        $statement->close(); 
      }
      else
      {
        $statement->close(); 

        $page_content = stripslashes($lookup) .' - ' . stripslashes($fact);
 
        $statement = $dbconn->prepare("INSERT INTO `log` (`id` ,`type` ,`message`) VALUES (NULL , 'search', ?)");       
        $statement->bind_param("s", $question);
        $statement->execute();
        $statement->close();
      }
    }
    else
    {
      $page_content = $this->action_default($dbconn);
    }

    return $page_content;
  }

  function action_add($dbconn, $lookup, $fact)
  {
    $lookup = stripslashes(strip_tags(trim($lookup)));
    $fact = stripslashes(strip_tags(trim($fact)));

    if ($lookup == '' || $fact == '')
    {
      $page_content = "Mate, you forgot to enter something to add to my knowledge. What's the story?";
    }
    else
    {
      $statement = $dbconn->prepare("INSERT INTO `facts` (`id` ,`lookup` ,`fact`) VALUES (NULL, ?, ?)");
      $statement->bind_param("ss", $lookup, $fact);
      $statement->execute();
      $statement->close();

      $statement = $dbconn->prepare("INSERT INTO `log` (`id` ,`type` ,`message`) VALUES (NULL, ?, ?)");
      $type = "add";
      $message = $lookup." = ".$fact;
      $statement->bind_param("ss", $type, $message);
      $statement->execute();
      $statement->close();

      $page_content = 'Alright, now I know about <a href="./?c=georgeopedia&action=query&question='
                      . $lookup . '">' . $lookup . '</a>.';
    }

    return $page_content;
  }

}

?>
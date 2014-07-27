<?php

/***************************************************************************
 *                             ds/class_mysql_multi_record.php
 *                            --------------------
 *   begin                : 7 June 2004
 *   copyright            : (C) 2004 N. McHardy
 *   email                : admin@nisch.org
 *
 *   desc:
 * class for creating an object which links to MANY record in a mysql table
 *
 ***************************************************************************/
 
 
class mysql_multi_record
{
  var $fields = array();
  var $settings = array();
  var $count = 0;

  function mysql_multi_record($table_prefix, $table_name, $where_clause)
  {
    // settings variables
    $this->settings["table_prefix"] = $table_prefix;
    $this->settings["table_name"] = $table_name;
    $this->settings["where_clause"] = $where_clause;

    // MySQL call to retrieve record
    $result = mysql_query("SELECT * FROM " . $table_prefix . $table_name . " " . $where_clause);
    if (!$result) {
        echo("<p>Error performing query: " . mysql_error() . "</p>");
        exit();
    }
    $this->count = mysql_num_rows($result);
    while (($row = mysql_fetch_array($result)))
    {
      $this->fields[] = $row;
    }
  }

  function field($field_name, $new_value = null)
  {
    // returns or sets a field

    if ($new_value != null)
    {
      // set field
      //$this->{fields}[$recordid][$field_name] = $new_value;
      //return $new_value;
    }
    else
    {
      // return field
      $field_array = array();
      
      foreach ($this->{fields} as $record)
      {
        $field_array[] = $record[$field_name];
      }
      
      return $field_array;
    }
  }
  
  function count_records()
  {
    return count($this->fields);	
  }

  function update_database()
  {
    // MySQL call to update record
    /*
    // Create sql query
    $second = false;
    foreach ($this->fields as $field => $value)
    {
      if ($second)
      {
        // only every 2nd entry in the array of fields is added to the query because things are doubled up
              //  one under the 'field_name', the other is under the field number, eg 1, 2, 3.
        $query .= $field . " = " . "'" . $value . "',\n";
      }
      $second = !$second;
    }
    $query = "UPDATE " . $this->{settings}["table_prefix"] . $this->{settings}["table_name"] .
             "\nSET " . substr($query, 0, strlen($query) - 2) .
             " " . $this->{settings}["where_clause"];

    $result = mysql_query($query);
    if (!$result) {
        echo("<p>Error performing query: " . mysql_error() . "</p>");
        exit();
    }
    */
  }
}

?>

<?php

/***************************************************************************
 *                             ds/class_mysql_record.php
 *                            --------------------
 *   begin                : 18 May 2004
 *   copyright            : (C) 2004 N. McHardy
 *   email                : admin@nisch.org
 *
 *   desc:
 * class for creating an object which links to one record in a mysql table
 *
 ***************************************************************************/
 
 
class mysql_record
{
  var $settings = array();
  var $fields = array();

  function mysql_record($table_prefix, $table_name, $where_clause)
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
    while (($row = mysql_fetch_array($result)))
    {
      $this->fields = $row;
    }
  }

  function field($field_name, $new_value = null)
  {
    // returns or sets a field

    if ($new_value === null)
    {
      // return field
      return $this->{fields}[$field_name];
    }
    else
    {
      // set field
      $this->{fields}[$field_name] = $new_value;
      return $new_value;
    }
  }

  function update_database()
  {
    // MySQL call to update record

    // Create sql query
    $second = false;
    foreach ($this->fields as $field => $value)
    {
      if ($second && strpos($field, 'blob') === false)
      {
        //avoid fields containing 'blob' because they cannot be updated using this method
      
        // only every 2nd entry in the array of fields is added to the query because things are doubled up
              //  one under the 'field_name', the other is under the field number, eg 1, 2, 3.
        $value_slashes = ereg_replace("'", "\'", $value);
        $query .= "`" . $field . "` = " . "'" . $value_slashes . "',\n";
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
  }
}

?>

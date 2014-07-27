<?php

$heading = 'List of Ideas';

// Get ideas from database

	$sql = "SELECT * FROM ideas order by id desc";

	if ( @mysql_query ( $sql ) )
	{
		$query = mysql_query ( $sql );
		$row = mysql_fetch_assoc ( $query );
                $content .= '<ul id="listings">';
		do {

                  $content .= '<li>';
                  $content .= '<h2>Idea #' . $row['id'] . '</h2>';
                  $content .= '<span>' . $row['likes'] . ' people liked this idea</span>';
                  $content .= '<img src="images/line.png" />';
                  $content .= '<p>' . $row['description'] . '</p>';
                  $content .= '<a href="./?c=idea&id=' . $row['id'] . '">vote or solve...</a>';
                  $content .= '<div class="corner"></div>';
                  $content .= '</li>';

		} while ( $row = mysql_fetch_assoc ( $query ) );
                $content .= '</ul>';
	}
	else {
		die ( mysql_error () );
	}

?>

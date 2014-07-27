<?php

$heading = 'List of Ideas';

// Get ideas from database

	$sql = "SELECT * FROM ideas ORDER BY likes DESC, id DESC";

	if ( @mysql_query ( $sql ) )
	{
		$query = mysql_query ( $sql );
		$row = mysql_fetch_assoc ( $query );
		$content .= "<p>Voice your needs, create demand and get it developed and in your hands.</p>";
		$content .= '<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                    <fb:like href="http://www.facebook.com/pages/iapps4me/157049030993528"></fb:like>';

                $content .= '<ul id="listings">';
		do {
                  $content .= '<li>';
                  $content .= '<div class="title">';
                  $content .= '<h2>' . str_replace('<', '&lt;', str_replace('>', '&gt;', $row['title'])) . '&nbsp</h2>';
                  $content .= '<span>' . $row['likes'] . ' people liked this idea</span>';
                  $content .= '</div>';
                  $content .= '<img src="images/listing_highlight.png" />';
                  $content .= '<p>' . str_replace('<', '&lt;', str_replace('>', '&gt;', $row['description'])) . '</p>';
                  $content .= '<div class="more_details">| <a href="./?c=idea&id=' . $row['id'] . '">vote or solve...</a></div>';
                  $content .= '<div class="corner"></div>';
                  $content .= '</li>';

		} while ( $row = mysql_fetch_assoc ( $query ) );
                $content .= '</ul>';
	}
	else {
		die ( mysql_error () );
	}

?>

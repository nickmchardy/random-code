<?php

	// set your infomation.
	$host		=	'localhost';
	$user		=	'changeme';
	$pass		=	'changeme';
	$database	=	'changeme';

	// connect to the mysql database server.
	$connect = @mysql_connect ($host, $user, $pass);

	if ( $connect )
	{
                mysql_select_db($database, $connect);
	}
	else {
		trigger_error ( mysql_error(), E_USER_ERROR );
	}

?>

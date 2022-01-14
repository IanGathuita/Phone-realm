<?php
	// create a connection
	$conn = mysqli_connect(SERVER_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
	if(mysqli_connect_error()){
		$msg = "Sorry, There was a problem: ".mysqli_connect_errno().
		       " ".mysqli_connect_error();
		exit($msg);
	}
 ?>

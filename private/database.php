<?php

require_once('db_credentials.php');
function db_connect(){
	$connection = mysqli_connect(server, user, pass, name);
	if (mysqli_connect_errno()){
		echo mysqli_connect_error();
		return mysqli_connect_error();
	}
	else return $connection;
}

function db_disc(){
	if (isset($connection)) mysql_close($connection);
}

function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
  }

?>
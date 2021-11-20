<?php

function queryAll($table){
	global $db;

	$sql = "SELECT * FROM $table";
	$res = mysqli_query($db, $sql);
	return $res;
}
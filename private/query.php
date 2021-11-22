<?php

function queryAll($table){
	global $db;

	$sql = "SELECT * FROM $table";
	$res = mysqli_query($db, $sql);
	return $res;
}

function queryAllbyID($table, $id){
	global $db;

	$sql = "SELECT * FROM $table WHERE RegistryID = '$id'";
	//echo $sql;
	$res = mysqli_query($db, $sql);

	return $res;
}
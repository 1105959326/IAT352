<?php
ob_start();
session_start();

//connect to data base and implement all functions
require_once('database.php');
require_once('query.php');
require_once('function.php');

$db = db_connect();
$errors = [];
?>
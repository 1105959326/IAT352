<?php
ob_start();
session_start();

require_once('database.php');
require_once('query.php');
require_once('function.php');

$db = db_connect();
$errors = [];
?>
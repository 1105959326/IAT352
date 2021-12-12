<?php
require_once('../private/initialize.php');
//unset session and redirect to home page
unset($_SESSION['username']);
header('Location: login.php');
?>
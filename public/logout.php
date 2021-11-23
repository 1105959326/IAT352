<?php
require_once('../private/initialize.php');

unset($_SESSION['username']);

header('Location: login.php');

?>
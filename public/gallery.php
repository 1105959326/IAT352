<?php

require_once('../private/initialize.php');
$res = queryAll('artwork');
while ($row = mysqli_fetch_assoc($res)){
	echo $row['RegistryID'];
}
?>
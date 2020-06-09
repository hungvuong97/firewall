<?php

$path = $_POST['path'];
// print($path);
$files = scandir($dir,1);
$key = 1;

if ($files == false){
	$key = 0;
}else{
	$key = 1;
}

$add = shell_exec("sudo python3 ../script/file_system_protection/integrity_check_linux.py -x ".$path);

print_r($add);
?>
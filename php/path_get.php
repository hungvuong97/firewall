<?php
// print("!@3123");
$dir    = $_POST['path'];
$files = scandir($dir,1);
$key = 0;

$type = [];

if($files !== false){
	foreach ($files as $file) {
		if ($dir == "/"){
			$check = scandir($_POST['path'].$file,1);
		}else{
			$check = scandir($_POST['path']."/".$file,1);

		}
	if($check == false){
		$type[] = 0;
	}else{
 		$type[] = 1;
	}
} 
}

print(json_encode([$files,$type]));

?>
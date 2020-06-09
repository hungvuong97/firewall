<?php
// print("!@3123");
$dir    = $_POST['path'];
// print_r($dir);
$password  = $_POST['pass'];
$files = scandir($dir,1);
$key = 0;

// print_r($files);
if ($files == false){
	// printf("<br>it in<br>");
	$encrype = shell_exec("sudo python3 ../script/file_system_protection/demo.py -f -e "."'".$dir."'"." '".$password."'");
	// print_r($encrype);
}else{
	foreach ($files as $file) {
		printf($dir."/".$file);
		if($file != ".." and $file !="."){	
			$encrype = shell_exec("sudo python3 ../script/file_system_protection/demo.py -f -e "."'".$dir."/".$file."'"." '".$password."'");

		print_r($encrype);

		}
	}
}
  // cmd = "python3 script/file_system_protection/demo.py -f -p 3 -d " "'"+path+"'" + " '"+password+"'"
              
                // encrype
  // cmd = "python3 script/file_system_protection/demo.py -f -e " "'"+path+"'" + " '"+password+"'"
                
print(json_encode($files));

?>
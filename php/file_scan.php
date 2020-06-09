<?php
 
include 'config.php';


$db = new SQLite3('../data/check.sqlite');
$data = shell_exec('stat  -c "%y|| %s|| %n|||" '.upload_foder.'/*');

$data = explode("|||", $data);
foreach ($data as $row){

    

	$time = substr(explode("||",$row)[0],0,19);
	$large = intval(explode("||",$row)[1])/1024;
	$name = explode('/',explode("||",$row)[2])[5];
	

	$res = $db->querySingle('SELECT count(name) FROM check_file where name = "'.$name.'"');

    // print($res);
    // dd();
    if(intval($res) > 0){
    	continue;
    }

    print('python ../tool/o-checker/o-checker.py '.explode("||",$row)[2]);
	$output = shell_exec('sudo python ../tool/o-checker/o-checker.py '.explode("||",$row)[2]);
	print_r($output."<br>");

	if($output == "None!") {
		$check =0;
	}else{
		$check = 1;
	}
	// print($check);
	// break;
	// dd($check);

	print("INSERT INTO check_file(name,large_file,date_check,check_value) VALUES ('".$name."','".intval($large)."','".$time."','".$check."')");
	$db->exec("INSERT INTO check_file(name,large_file,date_check,check_value) VALUES ('".$name."','".intval($large)."','".$time."','".$check."')");
	// dd();
}

$newURL = HOST."file_secure.php";
header('Location: '.$newURL);
//   // print("INSERT INTO bkcs_custom_domain(domain,type) VALUES ('".$_POST["Domain"]."','".$_POST["Type"]."')");
// $db->exec("INSERT INTO mod_url_deny(url,description) VALUES ('".$_POST["url"]."','".$_POST["description"]."')");

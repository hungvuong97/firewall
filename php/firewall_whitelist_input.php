<?php

// $shell = shell_exec("sudo iptables-save > /opt/iptables.conf");
// die();
include 'config.php';
	session_start();
	// print_r($_POST);
	// die();
	$ip1Array = explode(",",$_POST['ip3']);
	$ip2Array = explode(",",$_POST['ip4']);
	$port1Array = explode(",",$_POST['port3']);
	$port2Array = explode(",",$_POST['port4']);

	if(strlen($_POST['ip3']) ==0){
		// $ip1Error = "IP đích không được rỗng";
			$e = 1;
	
	}
	else{
		foreach ($ip1Array as $ip) {
			if(substr_count($ip, ".") != 3){
				$ip1Error = "Không đúng định dạng IP nguồn";	
				$eflag = 1;
				break;
			}
		}
	}

	

	if(strlen($_POST['port3']) ==0){
		// $port1Error = "Cổng đích không được rỗng";
			 $e = 1;
	}else{
			foreach ($port1Array as $port) {
			// print_r($port);
			// die();
			if((int)$port > 65000){
				$port1Error = "Port phải nhỏ hơn 65000";	
				$eflag = 1;
				break;
			}
			if((int)$port < 1){
				$port1Error = "Port phải là số";	
				$eflag = 1;
				break;
			}
		}
	}

	if(strlen($_POST['ip4']) ==0){
		// $ip2Error = "IP nguồn không được rỗng";
					$e = 1;
	
	}
	else{
		foreach ($ip2Array as $ip) {
			if(substr_count($ip, ".") != 3){
				$ip1Error = "Không đúng định dạng IP nguồn";	
				$eflag = 1;
				break;
			}
		}
	}

	if(strlen($_POST['port4']) ==0){
		// $port1Error = "Cổng nguồn không được rỗng";
			$e = 1;
	}else{
		foreach ($port2Array as $port) {
		if((int)$port > 65000){
			$port2Error = "Port phải nhỏ hơn 65000";	
			$eflag = 1;
			break;
		}
		if((int)$port < 1){
				$port1Error = "Port phải là số";	
				$eflag = 1;
				break;
			}
	}
	}

	if(substr_count($_POST['ip3'], ",") > 4){
		$ip1Error = "IP đích chỉ chứa tối đa 5 lựa chọn";
			$eflag = 1;
	}
	if(substr_count($_POST['port3'], ",") > 4){
		$port1Error = "Cổng đích chỉ chứa tối đa 5 lựa chọn";
			$eflag = 1;
	}

	if(substr_count($_POST['ip4'], ",") > 4){
		$ip2Error = "IP nguồn chỉ chứa tối đa 5 lựa chọn";
			$eflag = 1;
	}
	if(substr_count($_POST['port4'], ",") > 4){
		$port2Error = "Cổng nguồn chỉ chứa tối đa 5 lựa chọn";
			$eflag = 1;
	}
	
	

	

	

	if(strlen($_POST['prefix1']) > 64 ){
		$prefixError = "Prefix phải từ 1 đến  64 kí tự";
			$eflag = 1;
	}

	if($eflag == 0){
		//call script
		$a =1;

	    // python blacklist_input.py --dst-port 80 --src-ip 192.168.1.22

	    // usage: blacklist_input.py [-h] [--protocol PROTOCOL] [--src-ip SRC_IP]
	    //                           [--dst-ip DST_IP] [--src-port SRC_PORT]
	    //                           [--dst-port DST_PORT] [--port PORT] [--ip IP]
	    //                           [--comment COMMENT] [-f]
		
		$command = "sudo python ../tool/python-iptables/whitelist_input.py --protocol ".$_POST['Protocol'];
		print_r($_POST['ip3']);
		if(strlen($_POST['ip3']) !=0){
			$command = $command." --src-ip ".$_POST['ip3'];
		}

		

		if(strlen($_POST['ip4']) !=0){
			$command = $command." --dst-ip ".$_POST['ip4'];
		}

		if(strlen($_POST['port']) !=0 ){
			$command = $command." --port ".$_POST['port'];
		}else{
			if(strlen($_POST['port3']) !=0){
				$command = $command." --src-port ".$_POST['port3'];
			}

			if(strlen($_POST['port4']) !=0){
				$command = $command." --dst-port ".$_POST['port4'];
			}
		}

		if(strlen($_POST['prefix1']) !=0){
			$command = $command." --log bkcs-".$_POST['prefix1'];
		}else{
			
			$command = $command." --log bkcs-";
		}

	    print($command."<br>");
	    // die();
	    // $command = "l";
	    $shell = shell_exec($command);

	    
	    print_r($shell); 
	    $shell = shell_exec("sudo iptables-save > /opt/iptables.conf");
	   

	    // die();

		session_destroy();
	    session_start();
		
		$_SESSION['notification']="Thêm luật thành công vào IPS";
		$newURL = HOST."firewall.php";
		header('Location: '.$newURL);
	}else{

		$_SESSION['ip3Error']=$ip1Error;
		$_SESSION['ip4Error']=$ip2Error;
		$_SESSION['port3Error']=$port1Error;
		$_SESSION['port4Error']=$port2Error;
		$_SESSION['prefixError1']=$prefixError;
		$_SESSION['val1']=$_POST;

		$newURL = HOST."firewall.php";
		header('Location: '.$newURL);
	}
?>

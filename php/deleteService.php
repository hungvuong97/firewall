<?php

// $shell = shell_exec("sudo iptables-save > /opt/iptables.conf");
// die();
include 'config.php';
session_start();
$index = $_POST['index'];
$command = 'sudo python ../tool/python-iptables/manual_input.py -d '.$index;
shell_exec($command);
print_r($command);

// python manual_input.py -A -r "{\"comment\": {\"comment\": \"Match tcp.22\"}, \"protocol\": \"tcp\", \"target\": \"ACCEPT\", \"tcp\": {\"dport\": \"22\"}}"
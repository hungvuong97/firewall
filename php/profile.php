<?php

// $shell = shell_exec("sudo iptables-save > /opt/iptables.conf");
// die();
include 'config.php';
session_start();
$service = $_POST['service'];
$port = $_POST['port'];
$protocol = $_POST['protocol'];
$command = 'sudo python ../tool/python-iptables/manual_input.py -A -r "{\"comment\": {\"comment\": \"Match tcp.22\"}, \"protocol\": \"'.$protocol.'\", \"target\": \"ACCEPT\", \"tcp\": {\"dport\": \"'.$port.'\"}}"';
shell_exec($command);
print_r($command);

// python manual_input.py -A -r "{\"comment\": {\"comment\": \"Match tcp.22\"}, \"protocol\": \"tcp\", \"target\": \"ACCEPT\", \"tcp\": {\"dport\": \"22\"}}"
<?php
include 'config.php';
session_start();
$command1 = "sudo python ../tool/python-iptables/manual_input.py --f";
$command2 = "sudo python ../tool/python-iptables/manual_output.py --f";

$shell = shell_exec($command1);
$shell = shell_exec($command2);

echo json_encode(array('success' => 1));

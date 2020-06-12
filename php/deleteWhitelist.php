<?php
include 'config.php';
session_start();

$command3 = "sudo python ../tool/python-iptables/manual_input.py --f";
$command4 = "sudo python ../tool/python-iptables/manual_output.py --f";

$shell = shell_exec($command3);
$shell = shell_exec($command4);
echo json_encode(array('success' => 1));

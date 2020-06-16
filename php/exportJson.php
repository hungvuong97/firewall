<?php
include 'config.php';
session_start();
$command = 'sudo python ../tool/python-iptables/manual_input.py -L';
$shell = shell_exec($command);
file_put_contents('/home/vuongdh/file.txt', $shell);
shell_exec('sudo chmod -R 777 /home/vuongdh/file.txt');

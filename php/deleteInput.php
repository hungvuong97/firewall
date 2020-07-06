<?php

$index = $_POST['index'];
$jsonString = file_get_contents('../input.json');
$data = json_decode($jsonString, true);
if ($index == 1) {
    $command = 'sudo python ../tool/python-iptables/blacklist_input.py -f';
    shell_exec($command);
    $data['flag'] = 0;
} else {
    $command = 'sudo python ../tool/python-iptables/whitelist_input.py -f';
    shell_exec($command);
    $data['flag'] = 1;
}   
$newjson = json_encode($data);
file_put_contents('../input.json', $newjson);

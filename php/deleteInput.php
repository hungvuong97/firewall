<?php

$index = $_POST['index'];
$jsonString = file_get_contents('../input.json');
$data = json_decode($jsonString, true);
if ($index == 1) {
    $data['flag'] = 0;
    $newjson = json_encode($data);
    file_put_contents('../input.json', $newjson);
    $command = 'sudo python ../tool/python-iptables/blacklist_input.py -f';
    shell_exec($command);
    
} else {
    $data['flag'] = 1;
    $newjson = json_encode($data);
    file_put_contents('../input.json', $newjson);
    $command = 'sudo python ../tool/python-iptables/whitelist_input.py -f';
    shell_exec($command);
    $command = 'sudo python ../tool/python-iptables/whitelist_input.py --protocol tcp --src-ip 127.0.0.1 --src-port 8080 --log bkcs-';
    shell_exec($command);
    $command = 'sudo python ../tool/python-iptables/whitelist_input.py --protocol tcp --dst-ip 127.0.0.1 --dst-port 8080 --log bkcs-';
    shell_exec($command);
}

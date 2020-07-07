<?php

// $shell = shell_exec("sudo iptables-save > /opt/iptables.conf");
// die();
include 'config.php';
session_start();
$checked = $_POST['check'];
$unchecked = $_POST['uncheck'];
// print_r($unchecked);


$data = file_get_contents('../manual_service.json');
$json_arr = json_decode($data, true);
$arr_index = [];
foreach ($json_arr as $key => $value) {
    if ($value['port'] == $_POST['port']) {
        $arr_index = $key;
    }
}
// echo $arr_index;
unset($json_arr[$arr_index]);

$json_arr = array_values($json_arr);
file_put_contents('../manual_service.json', json_encode($json_arr));


$countUnCheck = count($unchecked);
// print_r($countUnCheck);
if ($countUnCheck > 0) {
    for ($i = 0; $i <= $countUnCheck - 1; $i++) {

        if ($unchecked[$i]['input_output'] == 'Input') {
            $command = 'sudo python ../tool/python-iptables/manual_input.py -A -r "{\"comment\": {\"comment\": \"Match ' . $unchecked[$i]['service'] . '\"}, \"protocol\": \"' . $unchecked[$i]['protocol'] . '\", \"target\": \"' . $unchecked[$i]['target'] . '\", \"tcp\": {\"dport\": \"' . $unchecked[$i]['port'] . '\"}}"';
            shell_exec($command);
            $command = '';
        } else {
            $command = 'sudo python ../tool/python-iptables/manual_output.py -A -r "{\"comment\": {\"comment\": \"Match ' . $unchecked[$i]['service'] . '\"}, \"protocol\": \"' . $unchecked[$i]['protocol'] . '\", \"target\": \"' . $unchecked[$i]['target'] . '\", \"tcp\": {\"dport\": \"' . $unchecked[$i]['port'] . '\"}}"';
            shell_exec($command);
            $command = '';
        }
    }
}

$countCheck = count($checked);
// print_r($countCheck);
if ($countCheck > 0) {
    for ($i = 0; $i <= $countCheck - 1; $i++) {
        if ($checked[$i]['inout'] == 'Input') {
            $command = 'sudo python ../tool/python-iptables/manual_input.py -d ' . $checked[$i]['index'];
            shell_exec($command);
            $command = '';
        } else {
            $command = 'sudo python ../tool/python-iptables/manual_output.py -d ' . $checked[$i]['index'];
            shell_exec($command);
            $command = '';
        }
    }
}
// $service = $_POST['service'];
// $port = $_POST['port'];
// $protocol = $_POST['protocol'];
// $input_output = $_POST['input_output'];
// $target = $_POST['target'];
// if ($input_output == 'Input') {
//     $command = 'sudo python ../tool/python-iptables/manual_input.py -A -r "{\"comment\": {\"comment\": \"Match tcp.22\"}, \"protocol\": \"' . $protocol . '\", \"target\": \"' . $target . '\", \"tcp\": {\"dport\": \"' . $port . '\"}}"';
//     shell_exec($command);
//     print_r($command);
// }

// if ($input_output == 'Output') {
//     $command = 'sudo python ../tool/python-iptables/manual_output.py -A -r "{\"comment\": {\"comment\": \"Match tcp.22\"}, \"protocol\": \"' . $protocol . '\", \"target\": \"' . $target . '\", \"tcp\": {\"dport\": \"' . $port . '\"}}"';
//     shell_exec($command);
//     print_r($command);
// }

// python manual_input.py -A -r "{\"comment\": {\"comment\": \"Match tcp.22\"}, \"protocol\": \"tcp\", \"target\": \"ACCEPT\", \"tcp\": {\"dport\": \"22\"}}"
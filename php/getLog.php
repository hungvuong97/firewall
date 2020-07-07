<?php
$mydate = getdate(date("U"));
$day = $mydate['mday'];
$t = $mydate['month'];
$month = substr($t, 0, 3);

$string = file_get_contents("../ip_input.json");
$json_a = json_decode($string, true);
$length = count($json_a);
$array = [];
for ($i = 0; $i < $length; $i++) {
    array_push($array, $json_a[$i]['ip']);
};
$ipInput = array_unique($array);

$string = file_get_contents("../ip_output.json");
$json_a = json_decode($string, true);
$length = count($json_a);
$array = [];
for ($i = 0; $i < $length; $i++) {
    array_push($array, $json_a[$i]['ip']);
};
$ipOutput = array_unique($array);

$string = file_get_contents("../port_input.json");
$json_a = json_decode($string, true);
$length = count($json_a);
$array = [];
for ($i = 0; $i < $length; $i++) {
    array_push($array, $json_a[$i]['port']);
};
$portInput = array_unique($array);

$string = file_get_contents("../port_output.json");
$json_a = json_decode($string, true);
$length = count($json_a);
$array = [];
for ($i = 0; $i < $length; $i++) {
    array_push($array, $json_a[$i]['port']);
};
$portOutput = array_unique($array);


$ipinput = [];
foreach ($ipInput as $val) {
    $command = "sudo cat /var/log/kern.log | grep bkcs | grep " . $val . " -c ";
    $count = shell_exec($command);
    $data = [
        'ip' => $val,
        'count' => $count
    ];
    array_push($ipinput, $data);
}

$ipoutput = [];
foreach ($ipOutput as $val) {
    $command = "sudo cat /var/log/kern.log | grep bkcs | grep " . $val . " -c ";
    $count = shell_exec($command);
    $data = [
        'ip' => $val,
        'count' => $count
    ];
    array_push($ipoutput, $data);
}

$portinput = [];
foreach ($portInput as $val) {
    $command = "sudo cat /var/log/kern.log | grep bkcs | grep " . $month . " " . $day . " | grep DPT=" . $val . " -c ";
    $count = shell_exec($command);
    $data = [
        'port' => $val,
        'count' => $count
    ];
    array_push($portinput, $data);
}

$portoutput = [];
foreach ($portOutput as $val) {
    $command = "sudo cat /var/log/kern.log | grep bkcs | grep " . $month . " " . $day . " | grep DPT=" . $val . " -c ";
    $count = shell_exec($command);
    $data = [
        'port' => $val,
        'count' => $count
    ];
    array_push($portoutput, $data);
}
echo json_encode([$ipinput,$ipoutput, $portinput, $portoutput]);

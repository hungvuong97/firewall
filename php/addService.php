<?php
include 'config.php';
session_start();
$myFile = '../manual_service.json';
$formdata = [
    'service' => $_POST['service'],
    'port' => $_POST['port'],
    'protocol' => $_POST['protocol'],
    'i/o' => $_POST['I/O'],
    'target' => $_POST['target']
];
$jsondata = file_get_contents($myFile);
$arr_data = json_decode($jsondata, true);
array_push($arr_data,$formdata);
$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
file_put_contents($myFile, $jsondata);
print_r(file_get_contents($myFile));
// die();
$newURL = HOST . "firewall.php";
header('Location: ' . $newURL);

<?php
$mydate = getdate(date("U"));
$day = $mydate['mday'];
$t = $mydate['month'];
$month = substr($t, 0, 3);

$command = "sudo cat /var/log/kern.log | grep bkcs | grep DPT=22 -c ";
$result1 = shell_exec($command);
$command = "sudo cat /var/log/kern.log | grep bkcs | grep DPT=21 -c ";
$result2 = shell_exec($command);


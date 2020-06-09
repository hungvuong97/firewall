<?php
$list = shell_exec("python3 ../script/file_system_protection/integrity_check_linux.py -l");
print_r($list);

?>
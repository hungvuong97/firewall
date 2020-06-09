<?php
shell_exec("sudo apt remove ".$_POST["app"]." -y");
print_r("Đã xóa ứng dụng ")
?>
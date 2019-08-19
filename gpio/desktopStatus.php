<?php 
$file = file_get_contents('desktopStatus.txt');
echo((int)($file == "1"));
http_response_code(0);
?>

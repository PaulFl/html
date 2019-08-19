<?php 
$state = (shell_exec('sudo vcgencmd display_power'));
echo((int)$state[14]);
?>

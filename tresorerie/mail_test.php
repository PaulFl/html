<?php
$to_email = 'paul@fleury.io';
$subject = 'Dette trésorerie X3';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: tresorerie.paul.fleuryp@gmail.com';
echo mail($to_email,$subject,$message,$headers);
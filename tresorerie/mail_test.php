<?php
$to_email = 'paul@fleury.io';
$subject = 'Dette trésorerie X3';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: trez@x3lesang.fleury.io';
mail($to_email,$subject,$message,$headers);
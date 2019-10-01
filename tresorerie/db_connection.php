<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "paul";
    $dbpass = "paulflry";
    $db = "x3_tresorerie";


    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);


    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

?>

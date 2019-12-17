<!DOCTYPE html>
<html>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#de000a">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trésorerie X3</title>
</head>

<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>
<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<form>
    <br>
    <input type="button" value="Accueil" onclick="window.location.href='../index.php'"/>
</form>
<p>Surnom et mot de passe pour acceder à ton compte stp bb</p>

<form action="password_verif.php" method="post">
    <table>
        <tr>
            <td>
        <label><span>Surnom:  </span><input type="user" name="user"></label>
        <br>
        <label><span>MDP:  </span><input type="password" name="password"></label>
        <br>
        <br>
        <input type="submit" value="Ça part"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

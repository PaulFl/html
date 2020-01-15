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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <title>X3 le sangg</title>
</head>
<link href="tresorerie/minimal-table.css" rel="stylesheet" type="text/css">

<body>
<div id="titleAndArray">
</div>
<br>
<div id="imgAndCaption">
    <b> Cliques sur la photo pour parler business...</b> <br>
    <?php
    $i = 0;
    $path = "../x3_photos";
    $ext = "jpeg";
    $extra = "alt=\"Random Image\" float=\"left\"";
    $imgs = [];
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if (substr($file, strlen($file) - 4, 4) == $ext) {
                $imgs[$i++] = $file;
                echo $file;
            }
        }
        echo '<br>';
        natcasesort($imgs);
        foreach ($imgs as $im){
            echo $im;
        }
        closedir($handle);
        $today = getdate();
        $day = $today['mon']*31 + $today['mday'];
        //srand($today['mday'] + $today['mon']);

        //$r = rand(0, $i - 1);
        $r = $day % $i;

        echo "<a href=\"tresorerie/login.php\"><img src=\"x3_photos/{$imgs[$r]}\" alt=\"Etage roi\"/>";

    }
    ?>
</div>
</body>
</html>

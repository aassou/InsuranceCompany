<?php
$pdo = new PDO('mysql:host=localhost;dbname=amazigh_assurances', 'root', '');

$i=1;

//for ($i; $i<=53; $i++) {
    $filename = "data/tierce.sql";
    //echo $filename;
    $file = file_get_contents($filename);
    $pdo->query($file);
//}

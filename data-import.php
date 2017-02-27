<?php
$pdo = new PDO('mysql:host=localhost;dbname=amazigh_assurances', 'root', '');

$i=10;

//for ($i; $i<=6; $i++) {
    $filename = "data/clients5.sql";
    //echo $filename;
    $file = file_get_contents($filename);
    $pdo->query($file) or die(print_r($pdo->errorInfo()));
    $filename = "data/clients6.sql";
    //echo $filename;
    $file = file_get_contents($filename);
    $pdo->query($file) or die(print_r($pdo->errorInfo()));
//}

<?php
set_time_limit(2000000000000);
$pdo = new PDO('mysql:host=localhost;dbname=amazigh_assurances', 'root', '');
require 'model/Client.php';
require 'model/ClientManager.php';
$clientManager = new ClientManager($pdo);
$clients = $clientManager->getAll();
$i=1;
foreach($clients as $client){
    $clientManager->update2($client->id(), trim($client->nom()), trim($client->adresse()), trim($client->rue()), 
    trim($client->ville()), trim($client->activite()), trim($client->tel1()), trim($client->fax()), 
    trim($client->permis()), trim($client->tel2()), trim($client->cin()) );
}

//for ($i; $i<=10; $i++) {
    //$filename = "data/new_data_clients/client$i.sql";
    //echo $filename;
    //$file = file_get_contents($filename);
    //$pdo->query($file) or die(print_r($pdo->errorInfo()));
//}

<?php
$pdo = new PDO('mysql:host=localhost;dbname=amazigh_assurances', 'root', '');

$query = $pdo->query("SELECT * FROM t_client");

$clients = array();

while ( $data = $query->fetch(PDO::FETCH_ASSOC) ){
    echo "ID : ".$data["id"]." ####### Code : ".$data['code']."<br>";
}

$query->closeCursor();

<?php
require('../app/classLoad.php');
//Create Controller
$clientActionController = new AppController('client');
$keyword = '%'.$_POST['keyword'].'%';
//get object
$clients = $clientActionController->getAllByNom($keyword);
foreach ($clients as $client) {
	// put in bold the written text
	$nom = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $client->nom());
	// add new option
	echo '<li onclick="setItemClient(\''.str_replace("'", "\'", $client->nom()).'\', \''.$client->cin().
	'\', \''.$client->tel1().'\', \''.$client->tel2().'\', \''.$client->adresse().'\'
	, \''.$client->codeClient().'\', \''.$client->id().'\', \''.$client->civilite().'\', \''.$client->typeClient().'\')">'.$nom.'</li>';
}
?>

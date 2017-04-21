<?php
require('../app/classLoad.php');
//Create Controller
$clientActionController = new AppController('client');
$keyword = strtoupper(htmlentities($_POST['keyword']));
//get object
$clients = $clientActionController->getAllByNom($keyword);
foreach ($clients as $client) {
	// put in bold the written text
	$nom = str_replace($keyword, '<b>'.$keyword.'</b>', $client->nom());
	// add new option
	echo '<li onclick="setItemClient(\''.str_replace("'", "\'", $client->nom()).'\', \''.$client->cin(). '\', 
	\''.$client->dateNaissance().'\', \''.$client->civilite().'\', \''.$client->situationFamiliale().'\' , 
	\''.$client->typeClient().'\', \''.$client->activite().'\', \''.$client->adresse().'\' , 
	\''.$client->rue().'\', \''.$client->ville().'\', \''.$client->codeRegion().'\' , 
	\''.$client->tel1().'\', \''.$client->tel2().'\', \''.$client->fax().'\' , 
	\''.$client->email().'\', \''.$client->permis().'\', \''.$client->datePermis().'\' , 
    \''.$client->solvabilite().'\',\''.$client->nombreIncident().'\',
	\''.$client->codeClient().'\', \''.$client->id().'\')">'.$nom.'</li>';
}
?>

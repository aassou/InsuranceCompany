<?php
require ('../app/classLoad.php');
if ( isset($_POST['numberAttestation']) ) {
    $resultat1 = "";
    $resultat2 = "";
    $numberAttestation           = htmlentities($_POST['numberAttestation']);
    $attestationActionController = new AppController('attestation');
    $contratAutoActionController = new AppController('contratAuto');
    //test if our number exists in our db
    if ( $attestationActionController->exist($numberAttestation) == 0 ) {
        $resultat1 = "Ce numéro n'existe pas";    
    }
    else {
        $resultat1 = "";
    }
    
    if ( $contratAutoActionController->exist($numberAttestation) != 0 ) {
        $resultat2 = "Ce numéro est déjà utilisé";
    }
    else {
        $resultat2 = "";
    }
    echo $resultat1.$resultat2;
}
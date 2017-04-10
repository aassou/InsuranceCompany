<?php
if ( isset($_POST['branche']) ) {
    $idBranche = htmlentities($_POST['idBranche']);
    $requete = "SELECT * FROM t_branche WHERE id = '".$idBranche."'";
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=amazigh_assurances', 'root', '');
    } 
    catch(Exception $e){
        exit('Impossible de se connecter à la base de données.');
    }
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $res = '<input type="hidden" id="brancheTauxCommission" value="'.$donnees['tauxCommission'].'">';
        $res = '<input type="hidden" id="brancheTauxTaxe" value="'.$donnees['tauxTaxe'].'">';
        echo $res;
    }
}
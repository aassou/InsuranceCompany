<?php
require ('../app/classLoad.php');
if ( isset($_POST['branche']) ) {
    $idBranche = htmlentities($_POST['branche']);
    $requete = "SELECT * FROM t_branche WHERE id = '".$idBranche."'";
    try{
        $bdd = PDOFactory::getMysqlConnection();
    } 
    catch(Exception $e){
        exit('Impossible de se connecter à la base de données.');
    }
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $res = '<input type="hidden" id="brancheCommission" value="'.$donnees['tauxCommission'].'">';
        $res .= '<input type="hidden" id="brancheTax" value="'.$donnees['tauxTaxe'].'">';
        echo $res;
    }
}
<?php
require ('../app/classLoad.php');
if ( isset($_POST['classe']) ) {
    $codeClasse = htmlentities($_POST['classe']);
    $requete = "SELECT * FROM t_sousclasse WHERE codeClasse = '".$codeClasse."'";
    try{
        $bdd = PDOFactory::getMysqlConnection();
    } 
    catch(Exception $e){
        exit('Impossible de se connecter à la base de données.');
    }
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $res = '<option value="'.$donnees['code'].'">'.$donnees['code'].'</option>';
        echo $res;
    }
}
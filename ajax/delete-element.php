<?php
if ( isset($_POST['deleted_id']) ) {
    $idElement = htmlentities($_POST['deleted_id']);
    //$elementSource = htmlentities($_POST['elementSource']);
    $requete = "DELETE FROM t_tariffrontiere WHERE id = ".$idElement;
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=amazigh_assurances', 'root', '');
    } 
    catch(Exception $e){
        exit('Impossible de se connecter à la base de données.');
    }
    if ($bdd->query($requete)) {
        echo "YES";
    }
    else {
        echo "NO";
    }
}
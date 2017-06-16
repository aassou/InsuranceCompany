<?php
require ('../app/classLoad.php');
if ( isset($_POST['idUsage']) ) {
    $idUsage = htmlentities($_POST['idUsage']);
    $requete = "SELECT * FROM t_tarifsassurancesfrontieres WHERE id = '".$idUsage."'";
    try{
        $bdd = PDOFactory::getMysqlConnection();
    } 
    catch(Exception $e){
        exit('Impossible de se connecter à la base de données.');
    }
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $libellePeriode = "";
        $periode = 0;
        if ( $donnees['periode'] <= 10 ) 
        {
            $periode = $donnees['periode'];
            $libellePeriode = "jours";    
        }
        else 
        {
            $periode = $donnees['periode']/30;
            $libellePeriode = "mois";
        }
        $res  = '<table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Usage</th>
                            <th>Période</th>
                            <th>PrimeRC</th>
                            <th>Taxes</th>
                            <th>Prime DR</th>
                            <th>Taxes DR</th>
                            <th>Timbre</th>
                            <th>Prime Totale</th>
                            <th>% Prime Remorque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="hidden" id="periode">'.$donnees['periode'].'</td>
                            <td>'.$donnees['typeUsage'].'</td>
                            <td>'.$periode.' '.$libellePeriode.'</td>
                            <td>'.number_format($donnees['primeRC'], 2, ',', ' ').'</td>
                            <td>'.number_format($donnees['taxes'], 2, ',', ' ').'</td>
                            <td>'.number_format($donnees['primeDR'], 2, ',', ' ').'</td>
                            <td>'.number_format($donnees['taxesDR'], 2, ',', ' ').'</td>
                            <td>'.number_format($donnees['timbre'], 2, ',', ' ').'</td>
                            <td>'.number_format($donnees['primeTotale'], 2, ',', ' ').'</td>
                            <td>'.($donnees['tauxPrimeRemorque']*100).' %'.'</td>
                        </tr>
                    </tbody>
                </table>';
        echo $res;
    }
}
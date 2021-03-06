<?php
    require('../app/classLoad.php');
    require('../app/PDOFactory.php');
    session_start();
    if (isset($_SESSION['userAxaAmazigh'])) {
        //controllers
        $contratActionController = new AppController('contratAuto');
        $usageActionController   = new AppController('usage');
        $clientActionController  = new AppController('client');
        //objs and vars
        $idContrat = $_GET['idContrat'];
        $contrat   = $contratActionController->getOneById($idContrat);
        $client    = $clientActionController->getOneByCode($contrat->codeClient()); 
        ob_start();
    ?>
    <style type="text/css">p,h1,h2,h4{text-align: center;font-family : Arial;font-weight: 100;margin-bottom: 0px;} h1,h2{font-size: 16px;} table{border-collapse: collapse;width:100%;font-size:9px} table,th,td{border: 1px solid black;} .no-border{border: 0px;} td,th{padding : 5px;} th{background-color: #a8a8a8;}</style>
    <page backtop="5mm" backbottom="5mm" backleft="3mm" backright="3mm">
        <img style="float: right" src="../assets/img/axa2.jpg" />
    	<h1 style="text-align: left;font-weight: bold">Conditions Particulières Solutions Auto Axa </h1>
    	<h2 style="text-align: left;font-weight: bold;font-size: 12px"><?= $contrat->typeAffaire() ?></h2>
    	<p style="font-size: 9px;text-align: left">Le présent contrat d'assurance est composé des présentes Conditions particulières et des Conditions générales du contrat d'assurances &lt;&lt; Solution Auto AXA &gt;&gt;, objet de la décision du Ministre chargé des Finances n° 38201401911D du 30 Octobre 2014.</p>
    	<br>
    	<table>
            <tr>
                <th style="width:35%">Intermédiaire : <strong>AMAZIGH ASSURANCES</strong><br>220 Avenue MOHAMMED V IMM EL HASNAOUI 1ER ETAGE NADOR</th>
                <th style="width:20%">Tél : +212 5 36 35 20 21<br>Fax : +212 5 36 35 20 31</th>
                <th style="width:25%">amazighassurances@gmail.com</th>
                <th style="width:20%">N° agrément:<br>A2360480200950738<br>Date d'agrément : 10/06/2009</th>
            </tr>
        </table>
        <br>
    	<table>
            <tr>
                <td style="width:20%">N° de Police : <?= $contrat->police() ?></td>
                <td style="width:20%">N° d'attestation : <?= $contrat->attestation() ?></td>
                <td style="width:20%">Offre : Grand Public</td>
                <td style="width:40%" colspan="2">Véhicule assuré chez Axa sur les 12 derniers mois : OUI</td>
            </tr>
            <tr>
                <td style="width:40%" colspan="2">Usage : <?= $usageActionController->getOneById($contrat->idUsage())->designation() ?></td>
                <td style="width:20%">Type Contrat : <?= $contrat->definitiveProvisoire() ?></td>
                <td style="width:20%">Echéance contrat et prime : </td>
                <td style="width:20%">Délai d'avis d'échéance : </td>
            </tr>
            <tr>
                <td style="width:20%">Date d'effet : <?= $contrat->dateEffet() ?></td>
                <td style="width:20%">Date effet avenant : </td>
                <td style="width:20%">Date d'expiration : <?= $contrat->dateEcheance() ?></td>
                <td style="width:20%">Barème conventionnel : Non</td>
                <td style="width:20%">Capital fidélité:</td>
            </tr>
        </table>
        <br>
        <table>
        <tr>
            <th style="width:33%">Souscripteur : <strong><?= $client->civilite().' '.$client->nom() ?></strong></th>
            <th style="width:33%">Propriétaire : <strong><?= $client->civilite().' '.$client->nom() ?></strong></th>
            <th style="width:34%">Conducteur : <strong><?= $client->civilite().' '.$client->nom() ?></strong></th>
        </tr>
        <tr>
            <td>CIN/Patente : <strong><?= $client->cin() ?></strong></td>
            <td>CIN/Patente : <strong><?= $client->cin() ?></strong></td>
            <td>Né le : <strong><?= date('d/m/Y', strtotime($client->dateNaissance())) ?></strong></td>
        </tr>
        <tr>
            <td>Profession/activité : <strong><?= $client->activite() ?></strong></td>
            <td>Profession/activité : <strong><?= $client->activite() ?></strong></td>
            <td>N° de permis : <strong><?= $client->permis() ?></strong></td>
        </tr>
        <tr>
            <td>Adresse : <strong><?= $client->adresse() ?></strong></td>
            <td>Adresse : <strong><?= $client->adresse() ?></strong></td>
            <td>Délivré le : <strong><?= date('d/m/Y') ?></strong>, Lieu : <strong>Nador</strong></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th style="width:100%" colspan="3">Véhicule</th>
        </tr>
        <tr>
            <td colspan="2"><strong><?= strtoupper($contrat->marque()).' '.$contrat->puissanceFiscale().' CV '.$contrat->nombrePlaces().' Places' ?></strong></td>
            <td>Numéro d'immatriculation Véhicule : <strong><?= $contrat->matricule() ?></strong></td>
        </tr>
        <tr>
            <td>1<sup>ére</sup> mise en circulation : </td>
            <td>Valeur à neuf Véhicule : </td>
            <td>Valeur vénale Véhicule au jour de la souscription : </td>
        </tr>
        <tr>
            <td>Numéro d'immatriculation Remorque : </td>
            <td>Valeur à neuf Remorque : </td>
            <td>Valeur vénale Remorque au jour de la souscription : </td>
        </tr>
        <tr>
            <td colspan="2">Valeur Aménagement professionnels : </td>
            <td>Option Panne Mécanique</td>
        </tr>
        <tr>
            <td>Organisme de crédit - Date de fin crédit : </td>
            <td colspan="2">Fin garantie Constructeur (premier terme échu )</td>
        </tr>
        <tr>
            <td colspan="3">Type et lieu de stationnement : <strong>Autre - NADOR - NADOR</strong></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th style="width:20%" rowspan="2">Garanties</th>
            <th style="width:20%" colspan="3">Valeurs en DH</th>
            <th style="width:20%" rowspan="2">Extension/Exclusions rachetables</th>
            <th style="width:20%" colspan="2">Franchise</th>
            <th style="width:10%" rowspan="2">Prime Nette Annuelle</th>
        </tr>
        <tr>
            <th style="width:10%">Véhicule</th>
            <th style="width:10%">Remorque</th>
            <th style="width:10%">Radio</th>
            <th style="width:10%">Taux</th>
            <th style="width:10%">Minimum</th>
        </tr>
        <tr>
            <td>RESPONSABILITE CIVILE</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= number_format($contrat->primeTotale(), 2, ',', ' ') ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th style="width: 20%" rowspan="2">Garanties</th>
            <th style="width: 20%" colspan="3">Capital</th>
            <th style="width: 20%" rowspan="2">Frais Médicaux</th>
            <th style="width: 20%" colspan="2" rowspan="2">Indemnisation Hospitalisation</th>
            <th style="width: 10%" rowspan="2">Prime nette annuelle</th>
        </tr>
        <tr>
            <th style="width: 10%" colspan="2">Décès</th>
            <th style="width: 10%">Invalidité</th>
        </tr>
        
        <tr>
            <td style="width: 20%">Protection Familiale conducteur et passagers (PFCP)</td>
            <td style="width: 10%" colspan="2">EXLU</td>
            <td style="width: 10%">EXLU</td>
            <td style="width: 20%">EXLU</td>
            <td style="width: 20%" colspan="2"></td>
            <td style="width: 10%"></td>
        </tr>
        <tr>
            <td style="width: 20%">Individuelle accidents conducteur (IAC)</td>
            <td style="width: 10%" colspan="2">EXLU</td>
            <td style="width: 10%">EXLU</td>
            <td style="width: 20%">EXLU</td>
            <td style="width: 20%" colspan="2">EXLU</td>
            <td style="width: 10%"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width: 70%">Bénéficiaire(s) en cas de décès de l'assuré :</td>
            <th style="width: 20%">Total prime nette annuelle</th>
            <td style="width: 10%"><?= number_format($contrat->primeTotale(), 2, ',', ' ') ?></td>
        </tr>
    </table>
    <p style="text-align: left;font-size: 9px">
        (1)  Le capital assuré représente la limite de notre engagement. Le montant de l'indemnité est défini aux articles 21 et 22 des Conditions générales.
        <br>
        Prime à payer : Elle s'élève à 641.64 DH et tient compte de votre coefficient de réduction-majoration {CRM) de 1.00
    </p>
    <p style="text-align: left;font-size: 10px"><strong>Quittance N°: </strong></p>
    <br>  
    <table>
        <tr>
            <th style="width: 30%">Prime nette Comptant</th>
            <th style="width: 10%">Réduction</th>
            <th style="width: 10%">Taxes</th>
            <th style="width: 10%">Accessoires</th>
            <th style="width: 10%">CNAPC</th>
            <th style="width: 20%">Timbre attestation</th>
            <th style="width: 10%">Prime TTC</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <p style="text-align: left;font-size: 10px">
        Circonstances aggravantes : <br>
        Autres assurances couvrant le même risque : <br>
        Le souscripteur déclare donner son accord exprès à la clause d'arbitrage prévue aux articles 37, 39 et 40 des conditions générales.
    </p>
    <br>
    <p style="text-align: left;font-size: 10px;font-weight: bold">
        AXA Assurance Maroc : 120-122, avenue Hassan II - Casablanca 20000 - Maroc<br>
        Téléphone : + 212 (0)5 22 88 92 92 - Fax : + 212 (0)5 22 88 91 88 - Internet www.axa.ma<br>
        Entreprise régie par la loi n°17-99 portant code des assurances S.A. au capital de 900 000 000,00 dh
    </p>  
    <br><br><br><br><br>
    <div style="background-color: #a8a8a8;height: 50px">
        <p style="text-align: center;font-size: 16px;font-weight: bold;margin: auto;">Clauses</p>
    </div>
    <p style="text-align: left;font-size: 10px">
        Clause U01 — Etendue géographique : L'assurance du présent contrat produit ses effets au Maroc et dans les pays figurant expressément sur la carte verte à l'exception des pays qui y sont barrés. Les pays de la carte verte sont : Albanie — Allemagne — Andorre — Autriche — Belgique — Biélorussie — Bosnie-Herzégovine — Bulgarie — Chypre — Croatie — Danemark — Espagne — Estonie — Finlande — France — F.Y.R.O.M — Grèce — Hongrie — Irlande — Islande — Italie — Lettonie — Lituanie — Luxembourg, — Malte — Moldavie —Norvège - Pays-Bas — Pologne — Portugal — Rép. Islamique d'Iran — Rép. Slovaque — Rép. Tchèque — Royaume Uni de G B & Irlande du Nord — Serbie & Montenegro — Slovénie —Suède — Suisse — Tunisie — Turquie — Ukraine.
        <br>
        Par accord des parties, la garantie est étendue aux Etats suivants :
    </p>
    <br>
    <p style="text-align: left;font-size: 10px">
        Clause UO2 - Usage "A" tourisme : Le souscripteur déclare expressément que le véhicule, objet de l'assurance, n'est pas utilisé commercialement, même à titre exceptionnel, pour le transport ou la livraison de produits ou de marchandises, ou pour le transport à titre onéreux de personnes.
    </p>
    <br>
    <p style="text-align: left;font-size: 10px">
        Clause D1S - Durée ferme : Le présent contrat est souscrit pour la durée ferme indiquée aux conditions particulières. Il expire de plein droit et sans autre avis a la date mentionnée dans la rubrique «date d'expiration».
    </p>
    <br>
    <p style="text-align: left;font-size: 10px">
        Clause P01—Données Personnelles : Les données personnelles demandées par l'assureur ont un caractère obligatoire pour obtenir la souscription du présent contrat et l'exécution de l'ensemble des services qui y sont rattachés. Elles sont utilisées exclusivement à cette fin par les services de l'assureur et les tiers autorisés. La durée de conservation de ces données est limitée à la durée du contrat d'assurance et à la période postérieure pendant laquelle leur conservation est nécessaire pour permettre à l'assureur de respecter ses obligations en fonction des délais de prescription ou en application d'autres dispositions légales. Par ailleurs, la communication des informations de l'assuré/souscripteur est limitée aux communications obligatoires en fonction des obligations légales et réglementaires qui s'imposent à l'assureur et aux tiers légalement autorisés à obtenir lesdites informations. L'assureur garantit notamment le respect de la loi n''09-08 relative à la protection des personnes physiques à l'égard du traitemen' des données à caractère personnel. Les données sont protégées aussi bien sur support physique qu'électronique, de telle sorte que leur accès soit impossible à des tiers non autorisés.
        <br><br>
        L'assureur s'assure que les personnes habilitées à traiter les données personnelles connaissent leurs obligations légales en matière de protection de ces données et s'tiennent. Les données à caractère personnel peuvent à tout moment faire l'objet d'un droit d'accès, de modification, de rectification et d'opposition auprès du Service gestion des réclamations AXA Assurance Maroc par courrier à l'adresse :
        <br>
        120-122 Avenue Hassan Il — 20 000 Casablanca.
        <br>
        De manière expresse, l'assuré/souscripteur autorise l'assureur à utiliser ses coordonnées à des fins de prospections commerciales en vue de proposer d'autres services d'assurance. Il peut s'opposer par courrier à la réception de sollicitations commerciales.
    </p>
    <br><br><br>
    <p style="text-align: left;font-size: 16px; font-weight: bold">
        A Casablanca, le <?= date('d/m/Y') ?><br>   
    </p>
    <br><br>
    <table class="no-border" style="font-size: 16px; font-weight: bold">
        <tr class="no-border">
            <td class="no-border" style="width: 70%">Souscripteur</td>
            <td class="no-border" style="width: 30%">Axa Assurance Maroc</td>
        </tr>
    </table>
    <br>
    </page>
    <?php
        $content = ob_get_clean();
        
        require('../lib/html2pdf/html2pdf.class.php');
        try{
            $pdf = new HTML2PDF('P', 'A4', 'fr');
            $pdf->pdf->SetDisplayMode('fullpage');
            $pdf->writeHTML($content);
            $fileName = "ContratAuto-".date('Ymdhi').'.pdf';
            $pdf->Output($fileName);
        }
        catch(HTML2PDF_exception $e){
            die($e->getMessage());
        }
    }
    else {
        header('Location:../index.php');
    }

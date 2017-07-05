<?php
    require('../app/classLoad.php');
    require('../app/PDOFactory.php');
    session_start();
    if (isset($_SESSION['userAxaAmazigh'])) {
        //create Controller
        $assurancesFrontiersActionController       = new AppController('assurancesFrontiers');
        $tarifsAssurancesFrontiersActionController = new AppController('tarifsAssurancesFrontieres');
        //get objects
        $assurancesFrontiersID     = $_GET['id'];
        $assurancesFrontiers       = $assurancesFrontiersActionController->getOneById($assurancesFrontiersID);
        $tarifsAssurancesFrontiers = $tarifsAssurancesFrontiersActionController->getOneById($assurancesFrontiers->idUsage());
        $primeRC = $tarifsAssurancesFrontiers->primeRC();
        $taxes   = $tarifsAssurancesFrontiers->taxes();
        $totalRC = $primeRC + $taxes;
        $primeDR = $tarifsAssurancesFrontiers->primeDR();
        $taxesDR = $tarifsAssurancesFrontiers->taxesDR();
        $totalDR = $primeDR + $taxesDR;
        $primeRemorque = $tarifsAssurancesFrontiers->primeRC()*$tarifsAssurancesFrontiers->tauxPrimeRemorque();
        $taxesRemorque = $tarifsAssurancesFrontiers->taxes()*$tarifsAssurancesFrontiers->tauxPrimeRemorque();
        $totalRemorque = $primeRemorque + $taxesRemorque;
        $timbre = 37;
        $primeTotale   = $totalRC + $totalDR + $totalRemorque + $timbre; 
        //tranform periode if it's >= 30 days to months
        $libellePeriode = "";
        $periode = 0;
        if ( $assurancesFrontiers->duree() <= 10 ) 
        {
            $periode = $assurancesFrontiers->duree();
            $libellePeriode = "jours";    
        }
        else 
        {
            $periode = $assurancesFrontiers->duree()/30;
            $libellePeriode = "mois";
        }    
        ob_start();
    ?>
    <style type="text/css">p{height:10px;}</style>
    <page>
        <p style="">
            <span style="margin-top: 115px;margin-left: 160px"><?= $assurancesFrontiers->police() ?></span>
            <span style="margin-top: 115px;margin-left: 180px"><?= $assurancesFrontiers->attestation() ?></span>
            <span style="margin-top: 130px;margin-left: -400px"><?= date('d/m/Y', strtotime($assurancesFrontiers->dateEffet())) ?></span>
            <span style="margin-top: 130px;margin-left: 70px"><?= $periode.' '.$libellePeriode ?></span>
            <span style="margin-top: 130px;margin-left: 145px"><?= date('d/m/Y', strtotime($assurancesFrontiers->dateExpiration())) ?></span>
            <span style="margin-top: 140px;margin-left: 240px"><?= $tarifsAssurancesFrontiers->typeUsage() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 130px;margin-left: 160px"><?= $tarifsAssurancesFrontiers->typeUsage() ?></span>
            <span style="margin-top: 130px;margin-left: 160px">9655</span>
            <span style="margin-top: 165px;margin-left: -300px"><?= $assurancesFrontiers->souscripteur() ?></span>
            <span style="margin-top: 165px;margin-left: 120px"><?= $assurancesFrontiers->proprietaire() ?></span>
            <span style="margin-top: 155px;margin-left: 260px"><?= $assurancesFrontiers->proprietaire() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 150px;margin-left: 200px"><?= $assurancesFrontiers->passeportSouscripteur() ?></span>
            <span style="margin-top: 150px;margin-left: 160px"><?= strtoupper($assurancesFrontiers->pays()) ?></span>
            <span style="margin-top: 140px;margin-left: 280px"><?= $assurancesFrontiers->passeport() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 140px;margin-left: 200px"><?= $assurancesFrontiers->permis() ?></span>
            <span style="margin-top: 120px;margin-left: 400px"><?= $assurancesFrontiers->adresse() ?></span>
            <span style="margin-top: 160px;margin-left: -570px"><?= date('d/m/Y', strtotime($assurancesFrontiers->datePermis())) ?></span>
            <span style="margin-top: 172px;margin-left: -40px"><?= $assurancesFrontiers->categorie() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 170px;margin-left: 160px"><?= strtoupper($assurancesFrontiers->marque()) ?></span>
            <span style="margin-top: 170px;margin-left: 160px"><?= strtoupper($assurancesFrontiers->type()) ?></span>
            <span style="margin-top: 185px;margin-left: -230px"><?= $assurancesFrontiers->immatriculation() ?></span>
            <span style="margin-top: 185px;margin-left: 170px"><?= $assurancesFrontiers->nombrePlaces() ?></span>
            <span style="margin-top: 200px;margin-left: -240px"><?= $assurancesFrontiers->poidsTotalCharge() ?></span>
            <span style="margin-top: 200px;margin-left: 155px"><?= $assurancesFrontiers->remorque() ?></span>
            <span style="margin-top: 195px;margin-left: 250px"><?= $assurancesFrontiers->police() ?></span>
            <span style="margin-top: 215px;margin-left: -600px"><?php if ( $assurancesFrontiers->cylindre() != 0 ){ echo $assurancesFrontiers->cylindre(); } else { echo "-"; }  ?></span>
            <span style="margin-top: 215px;margin-left: 200px"><?= $assurancesFrontiers->immatriculationRemorque() ?></span>
            <span style="margin-top: 215px;margin-left: 230px">Amazigh Assurances A/2360</span>
        </p>
        <p style="">
            <span style="margin-top: 230px;margin-left: 300px"><?= number_format($primeRC, 2, ',', ' ') ?></span>
            <span style="margin-top: 230px;margin-left: 20px"><?= number_format($taxes, 2, ',', ' ') ?></span>
            <span style="margin-top: 230px;margin-left: 30px"><?= number_format($totalRC, 2, ',', ' ') ?></span>
            <span style="margin-top: 220px;margin-left: 260px"><?= $assurancesFrontiers->immatriculation() ?></span>
            <span style="margin-top: 250px;margin-left: -40px"><?= strtoupper($assurancesFrontiers->marque().' '.$assurancesFrontiers->type()) ?></span>
            <span style="margin-top: 265px;margin-left: -80px"><?= ucfirst($tarifsAssurancesFrontiers->typeUsage()) ?></span>
            <span style="margin-top: 280px;margin-left: -60px"><?= $assurancesFrontiers->poidsTotalCharge() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 255px;margin-left: 300px"><?= number_format($primeDR, 2, ',', ' ') ?></span>
            <span style="margin-top: 255px;margin-left: 20px"><?= number_format($taxesDR, 2, ',', ' ') ?></span>
            <span style="margin-top: 255px;margin-left: 30px"><?= number_format($totalDR, 2, ',', ' ') ?></span>
            <span style="margin-top: 255px;margin-left: 260px"><?php if($assurancesFrontiers->remorque() == "Oui"){echo $assurancesFrontiers->immatriculationRemorque(); }else{echo $assurancesFrontiers->remorque(); } ?></span>
        </p>
        <?php if ( $assurancesFrontiers->remorque() == "Oui" ) { ?>
        <p style="">
            <span style="margin-top: 230px;margin-left: 310px"><?= number_format($primeRemorque, 2, ',', ' ') ?></span>
            <span style="margin-top: 230px;margin-left: 20px"><?= number_format($taxesRemorque, 2, ',', ' ') ?></span>
            <span style="margin-top: 230px;margin-left: 40px"><?= number_format($totalRemorque, 2, ',', ' ') ?></span>
            <span style="margin-top: 230px;margin-left: 270px"><?= $assurancesFrontiers->nombrePlaces() ?></span>
        </p>
        <?php 
        }
        else{
        ?>
        <p style="">
            <span style="margin-top: 230px;margin-left: 310px"></span>
            <span style="margin-top: 230px;margin-left: 20px"></span>
            <span style="margin-top: 230px;margin-left: 40px"></span>
            <span style="margin-top: 230px;margin-left: 370px"><?= $assurancesFrontiers->nombrePlaces() ?></span>
        </p>
        <?php } ?>
        <p style="">
            <span style="margin-top: 205px;margin-left: 435px"><?= number_format($timbre, 2, ',', ' ') ?></span>
            <span style="margin-top: 220px;margin-left: -40px"><?= number_format($primeTotale, 2, ',', ' ') ?></span>
        </p>
        <p style="">
            <span style="margin-top: 210px;margin-left: 735px"><?= date('d', strtotime($assurancesFrontiers->dateEffet())) ?></span>
            <span style="margin-top: 210px;margin-left: 45px"><?= date('m', strtotime($assurancesFrontiers->dateEffet())) ?></span>
            <span style="margin-top: 210px;margin-left: 55px"><?= date('Y', strtotime($assurancesFrontiers->dateEffet())) ?></span>
        </p>
        <p style="">
            <span style="margin-top: 190px;margin-left: 735px"><?= date('d', strtotime($assurancesFrontiers->dateExpiration())) ?></span>
            <span style="margin-top: 190px;margin-left: 45px"><?= date('m', strtotime($assurancesFrontiers->dateExpiration())) ?></span>
            <span style="margin-top: 190px;margin-left: 55px"><?= date('Y', strtotime($assurancesFrontiers->dateExpiration())) ?></span>
        </p>
    </page>
    <?php
        $content = ob_get_clean();
        
        require('../lib/html2pdf/html2pdf.class.php');
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->pdf->SetDisplayMode('fullpage');
            $pdf->writeHTML($content);
            $fileName = "AssurancesAuxFrontieres-".date('Ymdhi').'.pdf';
            $pdf->Output($fileName);
        }
        catch(HTML2PDF_exception $e){
            die($e->getMessage());
        }
    }
    else {
        header('Location:../index.php');
    }

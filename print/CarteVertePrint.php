<?php
    require('../app/classLoad.php');
    require('../app/PDOFactory.php');
    session_start();
    if (isset($_SESSION['userAxaAmazigh'])) {
        //create Controller
        $carteVerteActionController = new AppController('carteVerte');
        //get object
        $carteVerteID = $_GET['id'];
        $carteVerte   = $carteVerteActionController->getOneById($carteVerteID);
        ob_start();
    ?>
    <style type="text/css">p{height:10px;font-size:18px;font-weight:bold}</style>
    <page>
        <p style="">
            <span style="margin-top: 175px;margin-left: 365px"><?= date('d', strtotime($carteVerte->dateEffet())) ?></span>
            <span style="margin-top: 175px;margin-left: 20px"><?= date('m', strtotime($carteVerte->dateEffet())) ?></span>
            <span style="margin-top: 175px;margin-left: 20px"><?= date('Y', strtotime($carteVerte->dateEffet())) ?></span>
            <span style="margin-top: 175px;margin-left: 65px"><?= date('d', strtotime($carteVerte->dateExpiration())) ?></span>
            <span style="margin-top: 175px;margin-left: 20px"><?= date('m', strtotime($carteVerte->dateExpiration())) ?></span>
            <span style="margin-top: 175px;margin-left: 20px"><?= date('Y', strtotime($carteVerte->dateExpiration())) ?></span>
        </p>
        <p style="">
            <span style="margin-top: 165px;margin-left: 920px"><?= $carteVerte->numeroPolice() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 135px;margin-left: 370px"><?= $carteVerte->immatriculation() ?></span>
            <span style="margin-top: 135px;margin-left: 220px"><?= $carteVerte->categorie() ?></span>
            <span style="margin-top: 135px;margin-left: 90px"><?= $carteVerte->marque() ?></span>
        </p>
        <p style="">
            <span style="margin-top: 405px;margin-left: 370px"><?= $carteVerte->souscripteur() ?></span>
            <span style="margin-top: 425px;margin-left: -100px"><?= $carteVerte->adresse() ?></span>
        </p>
    </page>
    <?php
        $content = ob_get_clean();
        
        require('../lib/html2pdf/html2pdf.class.php');
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->pdf->SetDisplayMode('fullpage');
            $pdf->writeHTML($content);
            $fileName = "CarteVerte-".date('Ymdhi').'.pdf';
            $pdf->Output($fileName);
        }
        catch(HTML2PDF_exception $e){
            die($e->getMessage());
        }
    }
    else {
        header('Location:../index.php');
    }

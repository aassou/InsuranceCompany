<?php
include('config.php');
include('model/ReglementPrevu.php');
include('model/ReglementPrevuManager.php');
$prixNegocie = htmlentities($_POST['prixNegocie']);
$numero = htmlentities($_POST['numero']);
$typeBien = htmlentities($_POST['typeBien']);
$idBien = htmlentities($_POST['bien']);
$dateCreation = htmlentities($_POST['dateCreation']);
$avance = htmlentities($_POST['avance']);
$modePaiement = htmlentities($_POST['modePaiement']);
$dureePaiement = htmlentities($_POST['dureePaiement']);
$nombreMois = htmlentities($_POST['nombreMois']);
$echeance = htmlentities($_POST['echeance']);
$note = htmlentities($_POST['note']);
$idClient = htmlentities($_POST['idClient']);
$codeContrat = uniqid().date('YmdHis');
$created = date('Y-m-d h:i:s');
$createdBy = "abdou";

$reglementPrevuManager = new ReglementPrevuManager($pdo);

$condition = ceil( floatval($dureePaiement)/floatval($nombreMois) );
for ( $i=1; $i <= $condition; $i++ ) {
    $monthsNumber = "+".$nombreMois*$i." months";
    $datePrevu = date('Y-m-d', strtotime($monthsNumber, strtotime($dateCreation)));
    //echo $monthsNumber.'<br>';
    //echo $datePrevu.'<br>';
    //echo $nombreMois.'<br>';
    //echo $dateCreation.'<br>';
    $reglementPrevuManager->add(
        new ReglementPrevu(
            array(
                'datePrevu' => $datePrevu,
                'codeContrat' => $codeContrat,
                'status' => 0,
                'created' => $created,
                'createdBy' =>$createdBy
            )
        )
    );
}












?>




<?php
require('../app/classLoad.php');
spl_autoload_register("classLoad"); 
require('../app/PDOFactory.php');  
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <?php include('../include/head.php') ?>
    </head>
    <body class="fixed-top">
        <div class="header navbar navbar-inverse navbar-fixed-top">
          <?php include("../include/top-menu.php"); ?>
        </div>
        <div class="page-container row-fluid sidebar-closed">
            <?php include("../include/sidebar.php"); ?>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <h3 class="page-title">AxaAmazigh</h3>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <h4 class="breadcrumb"><i class="icon-hand-right"></i> Accueil</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
        <script>jQuery(document).ready( function(){ App.setPage("sliders"); App.init(); } );</script>
    </body>
</html>
<?php
}
else{
    header('Location:index.php');    
}
?>

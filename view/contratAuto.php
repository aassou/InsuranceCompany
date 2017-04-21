<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $contratAutoActionController = new ContratAutoActionController('contratAuto');
    //get objects
    $contratAutos = $contratAutoActionController->getContratAutos(); 
    /*$contratAutosNumber = $contratAutoActionController->getContratAutosNumber(); 
    $p = 1;
    if ( $contratAutosNumber != 0 ) {
        $contratAutoPerPage = 20;
        $pageNumber = ceil($contratAutosNumber/$contratAutoPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $contratAutoPerPage;
        $pagination = paginate('contratAuto.php', '?p=', $pageNumber, $p);
        $contratAutos = $contratAutoActionController->getContratAutosByLimits($begin, $contratAutoPerPage);
    }*/ 
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
                            <ul class="breadcrumb">
                                <li><i class="icon-home"></i><a href="dashboard.php">Accueil</a><i class="icon-angle-right"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addContratAuto box begin -->
                            <div id="addContratAuto" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter ContratAuto</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">ReferenceCabinet</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="referenceCabinet" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">IdCompagnie</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="idCompagnie" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Terme</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="terme" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Police</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="police" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Avenant</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="avenant" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TypeAffaire</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="typeAffaire" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Attestation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="attestation" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Quittance</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="quittance" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Apporteur</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="apporteur" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">IdBranche</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="idBranche" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">IdUsage</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="idUsage" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">IdClasse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="idClasse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">IdSousClasse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="idSousClasse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Marque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="marque" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Matricule</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="matricule" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">DefinitiveProvisoire</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="definitiveProvisoire" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PuissanceFiscale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="puissanceFiscale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">NombrePlaces</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nombrePlaces" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Carburant</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="carburant" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">DateProduction</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="dateProduction" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">DateEffet</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="dateEffet" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">NombreMois</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nombreMois" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">DateEcheance</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="dateEcheance" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeRC</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeRC" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">DefenseRecours</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="defenseRecours" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tierce</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tierce" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Collision</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="collision" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Vol</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="vol" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Incendie</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="incendie" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">BrisGlace</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="brisGlace" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Individuel</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="individuel" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeNette</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeNette" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TaxeAuto</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxeAuto" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TaxePTA</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxePTA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TotalTaxe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="totalTaxe" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">MontantPTA</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="montantPTA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Timbre</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="timbre" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Accessoires</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="accessoires" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeTotale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeTotale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">CommissionAuto</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="commissionAuto" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">CommissionPTA</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="commissionPTA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TotalCommission</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="totalCommission" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TPSAuto</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="TPSAuto" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TPSPTA</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="TPSPTA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TotalTPS</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="totalTPS" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="contratAuto" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addContratAuto box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des ContratAutos</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addContratAuto" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;ContratAuto
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">ReferenceCabinet</th>
                                                <th class="t10">IdCompagnie</th>
                                                <th class="t10">Terme</th>
                                                <th class="t10">Police</th>
                                                <th class="t10">Avenant</th>
                                                <th class="t10">TypeAffaire</th>
                                                <th class="t10">Attestation</th>
                                                <th class="t10">Quittance</th>
                                                <th class="t10">Apporteur</th>
                                                <th class="t10">IdBranche</th>
                                                <th class="t10">IdUsage</th>
                                                <th class="t10">IdClasse</th>
                                                <th class="t10">IdSousClasse</th>
                                                <th class="t10">Marque</th>
                                                <th class="t10">Matricule</th>
                                                <th class="t10">DefinitiveProvisoire</th>
                                                <th class="t10">PuissanceFiscale</th>
                                                <th class="t10">NombrePlaces</th>
                                                <th class="t10">Carburant</th>
                                                <th class="t10">DateProduction</th>
                                                <th class="t10">DateEffet</th>
                                                <th class="t10">NombreMois</th>
                                                <th class="t10">DateEcheance</th>
                                                <th class="t10">PrimeRC</th>
                                                <th class="t10">DefenseRecours</th>
                                                <th class="t10">Tierce</th>
                                                <th class="t10">Collision</th>
                                                <th class="t10">Vol</th>
                                                <th class="t10">Incendie</th>
                                                <th class="t10">BrisGlace</th>
                                                <th class="t10">Individuel</th>
                                                <th class="t10">PrimeNette</th>
                                                <th class="t10">TaxeAuto</th>
                                                <th class="t10">TaxePTA</th>
                                                <th class="t10">TotalTaxe</th>
                                                <th class="t10">MontantPTA</th>
                                                <th class="t10">Timbre</th>
                                                <th class="t10">Accessoires</th>
                                                <th class="t10">PrimeTotale</th>
                                                <th class="t10">CommissionAuto</th>
                                                <th class="t10">CommissionPTA</th>
                                                <th class="t10">TotalCommission</th>
                                                <th class="t10">TPSAuto</th>
                                                <th class="t10">TPSPTA</th>
                                                <th class="t10">TotalTPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $contratAutosNumber != 0 ) { 
                                            foreach ( $contratAutos as $contratAuto ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteContratAuto<?= $contratAuto->id() ?>" data-toggle="modal" data-id="<?= $contratAuto->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateContratAuto<?= $contratAuto->id() ?>" data-toggle="modal" data-id="<?= $contratAuto->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $contratAuto->referenceCabinet() ?></td>
                                                <td><?= $contratAuto->idCompagnie() ?></td>
                                                <td><?= $contratAuto->terme() ?></td>
                                                <td><?= $contratAuto->police() ?></td>
                                                <td><?= $contratAuto->avenant() ?></td>
                                                <td><?= $contratAuto->typeAffaire() ?></td>
                                                <td><?= $contratAuto->attestation() ?></td>
                                                <td><?= $contratAuto->quittance() ?></td>
                                                <td><?= $contratAuto->apporteur() ?></td>
                                                <td><?= $contratAuto->idBranche() ?></td>
                                                <td><?= $contratAuto->idUsage() ?></td>
                                                <td><?= $contratAuto->idClasse() ?></td>
                                                <td><?= $contratAuto->idSousClasse() ?></td>
                                                <td><?= $contratAuto->marque() ?></td>
                                                <td><?= $contratAuto->matricule() ?></td>
                                                <td><?= $contratAuto->definitiveProvisoire() ?></td>
                                                <td><?= $contratAuto->puissanceFiscale() ?></td>
                                                <td><?= $contratAuto->nombrePlaces() ?></td>
                                                <td><?= $contratAuto->carburant() ?></td>
                                                <td><?= $contratAuto->dateProduction() ?></td>
                                                <td><?= $contratAuto->dateEffet() ?></td>
                                                <td><?= $contratAuto->nombreMois() ?></td>
                                                <td><?= $contratAuto->dateEcheance() ?></td>
                                                <td><?= $contratAuto->primeRC() ?></td>
                                                <td><?= $contratAuto->defenseRecours() ?></td>
                                                <td><?= $contratAuto->tierce() ?></td>
                                                <td><?= $contratAuto->collision() ?></td>
                                                <td><?= $contratAuto->vol() ?></td>
                                                <td><?= $contratAuto->incendie() ?></td>
                                                <td><?= $contratAuto->brisGlace() ?></td>
                                                <td><?= $contratAuto->individuel() ?></td>
                                                <td><?= $contratAuto->primeNette() ?></td>
                                                <td><?= $contratAuto->taxeAuto() ?></td>
                                                <td><?= $contratAuto->taxePTA() ?></td>
                                                <td><?= $contratAuto->totalTaxe() ?></td>
                                                <td><?= $contratAuto->montantPTA() ?></td>
                                                <td><?= $contratAuto->timbre() ?></td>
                                                <td><?= $contratAuto->accessoires() ?></td>
                                                <td><?= $contratAuto->primeTotale() ?></td>
                                                <td><?= $contratAuto->commissionAuto() ?></td>
                                                <td><?= $contratAuto->commissionPTA() ?></td>
                                                <td><?= $contratAuto->totalCommission() ?></td>
                                                <td><?= $contratAuto->TPSAuto() ?></td>
                                                <td><?= $contratAuto->TPSPTA() ?></td>
                                                <td><?= $contratAuto->totalTPS() ?></td>
                                            </tr> 
                                            <!-- updateContratAuto box begin -->
                                            <div id="updateContratAuto<?= $contratAuto->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info ContratAuto</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">ReferenceCabinet</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="referenceCabinet"  value="<?= $contratAuto->referenceCabinet() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">IdCompagnie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="idCompagnie"  value="<?= $contratAuto->idCompagnie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Terme</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="terme"  value="<?= $contratAuto->terme() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Police</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="police"  value="<?= $contratAuto->police() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Avenant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="avenant"  value="<?= $contratAuto->avenant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TypeAffaire</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="typeAffaire"  value="<?= $contratAuto->typeAffaire() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Attestation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="attestation"  value="<?= $contratAuto->attestation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Quittance</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="quittance"  value="<?= $contratAuto->quittance() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Apporteur</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="apporteur"  value="<?= $contratAuto->apporteur() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">IdBranche</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="idBranche"  value="<?= $contratAuto->idBranche() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">IdUsage</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="idUsage"  value="<?= $contratAuto->idUsage() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">IdClasse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="idClasse"  value="<?= $contratAuto->idClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">IdSousClasse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="idSousClasse"  value="<?= $contratAuto->idSousClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Marque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="marque"  value="<?= $contratAuto->marque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Matricule</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="matricule"  value="<?= $contratAuto->matricule() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DefinitiveProvisoire</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="definitiveProvisoire"  value="<?= $contratAuto->definitiveProvisoire() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PuissanceFiscale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="puissanceFiscale"  value="<?= $contratAuto->puissanceFiscale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NombrePlaces</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nombrePlaces"  value="<?= $contratAuto->nombrePlaces() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Carburant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="carburant"  value="<?= $contratAuto->carburant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateProduction</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="dateProduction"  value="<?= $contratAuto->dateProduction() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateEffet</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="dateEffet"  value="<?= $contratAuto->dateEffet() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NombreMois</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nombreMois"  value="<?= $contratAuto->nombreMois() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateEcheance</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="dateEcheance"  value="<?= $contratAuto->dateEcheance() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeRC</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeRC"  value="<?= $contratAuto->primeRC() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DefenseRecours</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="defenseRecours"  value="<?= $contratAuto->defenseRecours() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tierce</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tierce"  value="<?= $contratAuto->tierce() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Collision</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="collision"  value="<?= $contratAuto->collision() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Vol</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="vol"  value="<?= $contratAuto->vol() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Incendie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="incendie"  value="<?= $contratAuto->incendie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">BrisGlace</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="brisGlace"  value="<?= $contratAuto->brisGlace() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Individuel</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="individuel"  value="<?= $contratAuto->individuel() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeNette</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeNette"  value="<?= $contratAuto->primeNette() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TaxeAuto</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxeAuto"  value="<?= $contratAuto->taxeAuto() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TaxePTA</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxePTA"  value="<?= $contratAuto->taxePTA() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TotalTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="totalTaxe"  value="<?= $contratAuto->totalTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MontantPTA</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montantPTA"  value="<?= $contratAuto->montantPTA() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Timbre</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="timbre"  value="<?= $contratAuto->timbre() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Accessoires</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="accessoires"  value="<?= $contratAuto->accessoires() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeTotale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeTotale"  value="<?= $contratAuto->primeTotale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CommissionAuto</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="commissionAuto"  value="<?= $contratAuto->commissionAuto() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CommissionPTA</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="commissionPTA"  value="<?= $contratAuto->commissionPTA() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TotalCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="totalCommission"  value="<?= $contratAuto->totalCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TPSAuto</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="TPSAuto"  value="<?= $contratAuto->TPSAuto() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TPSPTA</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="TPSPTA"  value="<?= $contratAuto->TPSPTA() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TotalTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="totalTPS"  value="<?= $contratAuto->totalTPS() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idContratAuto" value="<?= $contratAuto->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="contratAuto" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateContratAuto box end --> 
                                            <!-- deleteContratAuto box begin -->
                                            <div id="deleteContratAuto<?= $contratAuto->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer ContratAuto</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer ContratAuto : <?= $contratAuto->referenceCabinet() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idContratAuto" value="<?= $contratAuto->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="contratAuto" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteContratAuto box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($contratAutosNumber != 0){ echo $pagination; }*/ ?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
        <script>jQuery(document).ready( function(){ App.setPage("table_managed"); App.init(); } );</script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>

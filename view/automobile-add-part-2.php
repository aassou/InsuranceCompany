<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $compagnieController        = new AppController('compagnie');
    $regionActionController     = new AppController('region');
    $commercialActionController = new AppController('commercial');
    $clientActionController     = new AppController('client');
    $usageActionController      = new AppController('usage');
    $brancheActionController    = new AppController('branche');
    $classeActionController     = new AppController('classe');
    //get objects
    $codeClient  = $_GET['generatedCode'];
    $compagnies  = $compagnieController->getAll();
    $client      = $clientActionController->getOneByCode($codeClient);
    $commercials = $commercialActionController->getAll();
    $regions     = $regionActionController->getAll();  
    $usages      = $usageActionController->getAll();
    $branches    = $brancheActionController->getAll();
    $classes     = $classeActionController->getAll();
    //set a session for form inputs comming from automobile-add-part-1 in case of backwards
        if ( isset($_SESSION['form']) and $_SESSION['form']['name'] == 'contrat' ) {
            
    }
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
                                <li><i class="icon-briefcase"></i><a href="production.php">Production</a><i class="icon-angle-right"></i></li>
                                <li><i class="icon-truck"></i><a>Automobile</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid ">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- BEGIN TAB PORTLET-->   
                            <div class="portlet box blue tabbable">
                                <div class="portlet-title">
                                    <h4>Création Contart Assurance Automobile : Informations Contrat (étape 2/2)</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable portlet-tabs">
                                        <ul class="nav nav-tabs">
                                            <li><a href="#portlet_tab2" data-toggle="tab">Nouveau</a></li>
                                            <li class="active"><a href="#portlet_tab1" data-toggle="tab">Saisie par lot</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="portlet_tab1">
                                                <form id="automobile-add-part-2" class="horizontal-form" action="../app/Dispatcher.php" method="POST">
                                                    <h3>Client : <?= $client->nom() ?></h3>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="referenceCabinet">Référence Cabinet</label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" id="referenceCabinet" name="referenceCabinet" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="codeCompagnie">Compagnie</label>
                                                                <div class="controls">
                                                                    <select required="required" id="codeCompagnie" name="idCompagnie" class="m-wrap span12 bold">
                                                                        <?php foreach ( $compagnies as $compagnie ) { ?>
                                                                        <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                               <label class="control-label">Terme</label>
                                                               <div class="controls">
                                                                  <label class="radio"><div class="radio"><span><input type="radio" name="terme" value="Oui" style="opacity: 0;"></span></div>Oui</label>
                                                                  <label class="radio"><div class="radio"><span class="checked"><input type="radio" name="terme" value="Non" checked="" style="opacity: 0;"></span></div>Non</label>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group autocomplet_container">
                                                                <label class="control-label" for="police">Police</label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" id="police" name="police" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="avenant">Avenant</label>
                                                                <div class="controls">
                                                                    <input type="text" id="avenant" name="avenant" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="typeAffaire">Type Affaire</label>
                                                                <div class="controls">
                                                                    <select required="required" id="typeAffaire" name="typeAffaire" class="m-wrap span12 bold">
                                                                        <option value="AN">AN</option>
                                                                        <option value="RN">RN</option>
                                                                        <option value="RC">RC</option>
                                                                        <option value="RR">RR</option>
                                                                        <option value="DU">DU</option>
                                                                        <option value="MS">MS</option>
                                                                        <option value="CV">CV</option>
                                                                        <option value="RE">RE</option>
                                                                        <option value="EG">EG</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="attestation">Attestation</label>
                                                                <div class="controls">
                                                                    <input type="text" id="attestation" name="attestation" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="quittance">Quittance</label>
                                                                <div class="controls">
                                                                    <input type="text" id="quittance" name="quittance" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="apporteur">Apporteur</label>
                                                                <div class="controls">
                                                                    <select required="required" id="apporteur" name="apporteur" class="m-wrap span12 bold">
                                                                        <?php foreach ( $commercials as $commercial ) { ?>    
                                                                        <option value="<?= $commercial->raisonSocial() ?>"><?= $commercial->raisonSocial() ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="branche">Branche</label>
                                                                <div class="controls">
                                                                    <select required="required" id="branche" name="idBranche" class="m-wrap span12 bold">
                                                                        <?php foreach ( $branches as $branche ) { ?>    
                                                                        <option value="<?= $branche->id() ?>"><?= $branche->code()." : ".$branche->designation() ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="usage">Usage</label>
                                                                <div class="controls">
                                                                    <select required="required" id="usage" name="idUsage" class="m-wrap span12 bold">
                                                                        <?php foreach ( $usages as $usage ) { ?>    
                                                                        <option value="<?= $usage->id() ?>"><?= $usage->code() ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="codeClasse">Classe</label>
                                                                <div class="controls">
                                                                    <select required="required" id="codeClasse" name="idClasse" class="m-wrap span12 bold" onchange="getSousClasse('')">
                                                                        <?php foreach ( $classes as $classe ) { ?>    
                                                                        <option value="<?= $classe->code() ?>"><?= $classe->code() ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="codeSousClasse">SousClasse</label>
                                                                <div class="controls">
                                                                    <select required="required" id="codeSousClasse" name="idSousClasse" class="m-wrap span12 bold">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="marque">Marque Véhivule</label>
                                                                <div class="controls">
                                                                    <input type="text" id="marque" name="marque" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="matricule">Matricule</label>
                                                                <div class="controls">
                                                                    <input type="text" id="matricule" name="matricule" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3">
                                                            <div class="control-group">
                                                               <label class="control-label">Définitive/Provisoire</label>
                                                               <div class="controls">
                                                                  <label class="radio"><div class="radio"><span><input type="radio" name="definitiveProvisoire" value="Definitive" style="opacity: 0;"></span></div>Definitive</label>
                                                                  <label class="radio"><div class="radio"><span class="checked"><input type="radio" name="definitiveProvisoire" value="Provisoire" checked="" style="opacity: 0;"></span></div>Provisoire</label>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="puissanceFiscale">Puissance Fiscale</label>
                                                                <div class="controls">
                                                                    <input type="text" id="puissanceFiscale" name="puissanceFiscale" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="nombrePlaces">Nombre Places</label>
                                                                <div class="controls">
                                                                    <input type="text" id="nombrePlaces" name="nombrePlaces" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="carburant">Carburant</label>
                                                                <div class="controls">
                                                                    <select required="required" id="carburant" name="carburant" class="m-wrap span12 bold">
                                                                        <option value="D">D</option>
                                                                        <option value="E">E</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span3">
                                                            <div class="control-group">
                                                                <label class="control-label" for="dateProduction">Date de Production</label>
                                                                <div class="controls">
                                                                    <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                        <input name="dateProduction" id="dateProduction" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3">
                                                            <div class="control-group">
                                                                <label class="control-label" for="dateEffet">Date d'effet</label>
                                                                <div class="controls">
                                                                    <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                        <input name="dateEffet" id="dateEffet" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3">
                                                            <div class="control-group">
                                                                <label class="control-label" for="nombreMois">Nombre de Mois</label>
                                                                <div class="controls">
                                                                    <select required="required" id="nombreMois" name="nombreMois" class="m-wrap span12 bold">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3">
                                                            <div class="control-group">
                                                                <label class="control-label" for="dateEcheance">Date d'écheance</label>
                                                                <div class="controls">
                                                                    <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                        <input name="dateEcheance" id="dateEcheance" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="primeRC">Prime RC</label>
                                                                <div class="controls">
                                                                    <input type="text" id="primeRC" name="primeRC" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="defenseRecours">Défense/Recours</label>
                                                                <div class="controls">
                                                                    <input type="text" id="defenseRecours" name="defenseRecours" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="tierce">Tierce</label>
                                                                <div class="controls">
                                                                    <input type="text" id="tierce" name="tierce" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="collision">Collision</label>
                                                                <div class="controls">
                                                                    <input type="text" id="collision" name="collision" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="vol">Vol</label>
                                                                <div class="controls">
                                                                    <input type="text" id="vol" name="vol" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="incendie">Incendie</label>
                                                                <div class="controls">
                                                                    <input type="text" id="incendie" name="incendie" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="brisGlace">Bris Glace</label>
                                                                <div class="controls">
                                                                    <input type="text" id="brisGlace" name="brisGlace" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="individuel">Individuel</label>
                                                                <div class="controls">
                                                                    <input type="text" id="individuel" name="individuel" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="primeNette">Prime Nette</label>
                                                                <div class="controls">
                                                                    <input style="background-color: #7FDBFF" type="text" id="primeNette" name="primeNette" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="montantTaxeAuto">Taxe Auto</label>
                                                                <div class="controls">
                                                                    <input type="text" id="montantTaxeAuto" name="taxeAuto" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="montantTaxePTA">Taxe PTA</label>
                                                                <div class="controls">
                                                                    <input type="text" id="montantTaxePTA" name="taxePTA" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="totalTaxe">Total Taxe</label>
                                                                <div class="controls">
                                                                    <input type="text" id="totalTaxe" name="totalTaxe" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="montantPTA">Montant PTA</label>
                                                                <div class="controls">
                                                                    <input type="text" id="montantPTA" name="montantPTA" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="timbre">Timbre</label>
                                                                <div class="controls">
                                                                    <input type="text" id="timbre" name="timbre" value="37" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="accessoires">Accessoires</label>
                                                                <div class="controls">
                                                                    <input type="text" id="accessoires" name="accessoires" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label bold" for="primeTotale">Prime Totale</label>
                                                                <div class="controls">
                                                                    <input style="background-color: #39CCCC" type="text" id="primeTotale" name="primeTotale" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="commissionAuto">Commission Auto</label>
                                                                <div class="controls">
                                                                    <input type="text" id="commissionAuto" name="commissionAuto" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="commissionPTA">Commission PTA</label>
                                                                <div class="controls">
                                                                    <input type="text" id="commissionPTA" name="commissionPTA" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="totalCommission">Total commission</label>
                                                                <div class="controls">
                                                                    <input type="text" id="totalCommission" name="totalCommission" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="tpsAuto">TPS Auto</label>
                                                                <div class="controls">
                                                                    <input type="text" id="tpsAuto" name="TPSAuto" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="tpsPTA">TPS PTA</label>
                                                                <div class="controls">
                                                                    <input type="text" id="tpsPTA" name="TPSPTA" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="TotalTPS">Total TPS</label>
                                                                <div class="controls">
                                                                    <input type="text" id="totalTPS" name="totalTPS" value="0" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="hidden" name="action" value="add">
                                                        <input type="hidden" name="source" value="contratAuto">
                                                        <input type="hidden" id="codeClient" name="codeClient" value="<?= $codeClient ?>">
                                                        <div id="brancheSection"></div>
                                                        <input type="hidden" id="generatedCode" name="generatedCode" value="<?= uniqid().date('YmdHis') ?>">
                                                        <a href="automobile-add-part-1.php" class="btn black"><i class="m-icon-swapleft m-icon-white"></i> Retour</a>
                                                        <button type="submit" class="btn blue">Terminer <i class="icon-save m-icon-white"></i></button>
                                                    </div>
                                                </form>     
                                            </div>
                                            <div class="tab-pane" id="portlet_tab2">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo.  
                                                </p>
                                                <p>
                                                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>
        <script src="../assets/js/autocomplete.js" type="text/javascript"></script>     
        <script>
        jQuery(document).ready( function(){ 
            App.setPage("table_managed"); 
            App.init();
            //declare and initialize variables
            var brancheCommission = 0, brancheTax = 0, primeRC = 0, defenseRecours = 0, tierce = 0, 
            collision = 0, vol = 0, incendie = 0, brisGlace = 0, individuel = 0, primeNette = 0, 
            montantTaxAuto = 0, montantTaxPTA = 0, totalTaxe, tpsAuto = 0, tpsPTA = 0, totalTPS = 0, 
            commissionAuto = 0, commissionPTA =0, totalCommission = 0, primeTotale = 0, accessoires = 0,
            timbre = 37, dateEffet = '', dateProduction = '' , dateEcheance = '';
            //Dates sections
            var dateProduction = $('#dateProduction').val();
            var dateEffet      = $('#dateProduction').val();
            var dateEcheance   = $('#dateProduction').val();
            var nombreMois     = +$('#nombreMois').val();
            dateEffet          = new Date(dateEffet);
            dateEcheance       = new Date(dateEcheance);
            dateProduction     = new Date(dateProduction);
            //alert(dateEffet.toString('yyyy-MM-dd'));
            dateEffet.setDate(dateEffet.getDate()+1);
            $('#dateEffet').val(dateEffet.toString('yyyy-MM-dd'));
            dateEcheance.setDate(dateEcheance.getDate()+1);
            dateEcheance.setMonth(dateEcheance.getMonth() + nombreMois);
            $('#dateEcheance').val(dateEcheance.toString('yyyy-MM-dd'));
            //onload processing begins
            var id             = "#branche";
            var branche        = $(id).val();
            var brancheSection = "#brancheSection";
            var data           = 'branche='+branche;
            $.ajax({
                type: "POST",
                url: "../ajax/branches.php",
                data: data,
                cache: false,
                success: function(html){
                    $(brancheSection).html(html);
                    brancheCommission = +$('#brancheCommission').val();
                    brancheTax        = +$('#brancheTax').val(); 
                    primeRC           = +$('#primeRC').val();
                    montantTaxAuto    = (primeRC * brancheTax / 100) +
                    ( (14/100) * (defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel) );
                    montantTaxPTA     = 0;
                    totalTaxe          = montantTaxAuto + montantTaxPTA;
                    tpsAuto           = (12.281 / 100) * 
                    (primeRC + defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel);
                    tpsPTA            = 0;
                    totalTPS          = tpsAuto + tpsPTA;
                    commissionAuto    = (brancheCommission / 100) *
                    (primeRC + defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel);
                    commissionPTA     = 0;
                    totalCommission   = 0;
                    primeTotale       = 0 + primeNette + timbre + totalTaxe + accessoires; 
                    $('#montantTaxeAuto').val(montantTaxAuto);
                    $('#montantTaxePTA').val(montantTaxPTA);
                    $('#totalTaxe').val(totalTaxe);
                    $('#tpsAuto').val(tpsAuto);
                    $('#tpsPTA').val(tpsPTA);
                    $('#totalTPS').val(totalTPS);
                    $('#commissionAuto').val(commissionAuto);
                    $('#commissionPTA').val(commissionPTA);
                    $('#totalCommission').val(totalCommission);
                    $('#primeTotale').val(primeTotale);
                }
            });
            //onload processing ends
            //onchange dates begins
            $('#nombreMois').change(function(){
                dateProduction = $('#dateProduction').val();
                dateEffet      = $('#dateProduction').val();
                dateEcheance   = $('#dateProduction').val();
                nombreMois     = +$('#nombreMois').val();
                dateEffet      = new Date(dateEffet);
                dateEcheance   = new Date(dateEcheance);
                dateProduction = new Date(dateProduction);
                //alert(dateEffet.toString('yyyy-MM-dd'));
                dateEffet.setDate(dateEffet.getDate()+1);
                $('#dateEffet').val(dateEffet.toString('yyyy-MM-dd'));
                dateEcheance.setDate(dateEcheance.getDate()+1);
                dateEcheance.setMonth(dateEcheance.getMonth() + nombreMois);
                $('#dateEcheance').val(dateEcheance.toString('yyyy-MM-dd'));    
            });
            $('#dateProduction').datepicker().on('changeDate', function(){
                dateProduction = $('#dateProduction').val();
                dateEffet      = $('#dateProduction').val();
                dateEcheance   = $('#dateProduction').val();
                nombreMois     = +$('#nombreMois').val();
                dateEffet      = new Date(dateEffet);
                dateEcheance   = new Date(dateEcheance);
                dateProduction = new Date(dateProduction);
                //alert(dateEffet.toString('yyyy-MM-dd'));
                dateEffet.setDate(dateEffet.getDate()+1);
                $('#dateEffet').val(dateEffet.toString('yyyy-MM-dd'));
                dateEcheance.setDate(dateEcheance.getDate()+1);
                dateEcheance.setMonth(dateEcheance.getMonth() + nombreMois);
                $('#dateEcheance').val(dateEcheance.toString('yyyy-MM-dd'));    
            });
            //onchange dates ends
            //primeRC... onchange begins 
            $('#primeRC, #defenseRecours, #tierce, #collision, #vol, #incendie, #brisGlace, #individuel').change(function(){
                brancheCommission = +$('#brancheCommission').val();
                brancheTax        = +$('#brancheTax').val(); 
                primeRC           = +$('#primeRC').val();
                defenseRecours    = +$('#defenseRecours').val();
                tierce            = +$('#tierce').val();
                collision         = +$('#collision').val();
                vol               = +$('#vol').val();
                incendie          = +$('#incendie').val();
                brisGlace         = +$('#brisGlace').val();
                individuel        = +$('#individuel').val();
                primeNette        = primeRC + defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel;
                montantTaxAuto    = (primeRC * brancheTax / 100) +
                ( (14/100) * (defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel) );
                montantTaxPTA     = 0;
                totalTaxe          = montantTaxAuto + montantTaxPTA;
                tpsAuto           = (12.281 / 100) * 
                (primeRC + defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel);
                tpsPTA            = 0;
                totalTPS          = tpsAuto + tpsPTA;
                commissionAuto    = (brancheCommission / 100) *
                (primeRC + defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel);
                commissionPTA     = 0;
                totalCommission   = 0;
                (primeRC + defenseRecours + tierce + collision + vol + incendie + brisGlace + individuel);
                primeTotale       = 0 + primeNette + timbre + totalTaxe + accessoires;
                $('#primeNette').val(primeNette);
                $('#montantTaxeAuto').val(montantTaxAuto);
                $('#montantTaxePTA').val(montantTaxPTA);
                $('#totalTaxe').val(totalTaxe);
                $('#tpsAuto').val(tpsAuto);
                $('#tpsPTA').val(tpsPTA);
                $('#totalTPS').val(totalTPS);
                $('#commissionAuto').val(commissionAuto);
                $('#commissionPTA').val(commissionPTA);
                $('#totalCommission').val(totalCommission);
                $('#primeTotale').val(primeTotale);
            });
            //primeRC... onchange ends
            //branche onchange begins
            $('#branche').change(function(){
                id             = "#branche";
                branche        = $(id).val();
                brancheSection = "#brancheSection";
                data           = 'branche='+branche;
                $.ajax({
                    type: "POST",
                    url: "../ajax/branches.php",
                    data: data,
                    cache: false,
                    success: function(html){
                        $(brancheSection).html(html);
                        brancheCommission = +$('#brancheCommission').val();
                        brancheTax        = +$('#brancheTax').val(); 
                        primeRC           = +$('#primeRC').val();
                        montantTaxAuto    = primeRC * brancheTax / 100;
                        $('#montantTaxeAuto').val(montantTaxAuto);
                        $('#tpsAuto').val(tpsAuto);
                        $('#commissionAuto').val(commissionAuto);
                    }
                });
            });
            //branche onchange ends
            //validate form begins
            $("#automobile-add-part-2").validate({
                 rules:{
                   police: {
                       required: true,
                       number: true
                   },
                   attestation: {
                       required: true,
                       number: true
                   },
                   branche: {
                       required: true
                   }
                 },
                 errorClass: "error-class",
                 validClass: "valid-class"
            });
            //validate form ends
        });
        </script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>

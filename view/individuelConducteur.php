<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $individuelConducteurActionController = new AppController('individuelConducteur');
    $compagnieActionController            = new AppController('compagnie');
    $usageActionController                = new AppController('usage');
    //objects and vars
    $individuelConducteurs = $individuelConducteurActionController->getAll(); 
    $compagnies            = $compagnieActionController->getAll();
    $usages                = $usageActionController->getAll();
    /*$individuelConducteursNumber = $individuelConducteurActionController->getAllNumber(); 
    $p = 1;
    if ( $individuelConducteursNumber != 0 ) {
        $individuelConducteurPerPage = 20;
        $pageNumber = ceil($individuelConducteursNumber/$individuelConducteurPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $individuelConducteurPerPage;
        $pagination = paginate('individuelConducteur.php', '?p=', $pageNumber, $p);
        $individuelConducteurs = $individuelConducteurActionController->getAllByLimits($begin, $individuelConducteurPerPage);
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
                                <li><i class="icon-wrench"></i><a href="configuration.php">Paramètrages</a><i class="icon-angle-right"></i></li>
                                <li><i class="icon-user"></i><a>Individuel Conducteur</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addIndividuelConducteur box begin -->
                            <div id="addIndividuelConducteur" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Individuel Conducteur</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Compagnie</label>
                                            <div class="controls">
                                                <select name="codeCompagnie">
                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnieActionController->getOneById($compagnie->id())->raisonSociale() ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Usage</label>
                                            <div class="controls">
                                                <select name="codeUsage">
                                                    <?php foreach ( $usages as $usage ) { ?>
                                                    <option value="<?= $usage->code() ?>"><?= $usage->code() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Formule Individuel</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formuleIndividuel" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Capital Deces</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="capitalDeces" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Capital Invalidite</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="capitalInvalidite" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Montant Frais</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="montantFrais" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prime Nette</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeNette" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux Taxe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxTaxe" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Accessoire Individuel</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="accessoireIndividuel" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux Commission</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxCommission" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux TPS</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxTPS" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="individuelConducteur" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addIndividuelConducteur box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Individuel Conducteurs</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addIndividuelConducteur" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Individuel Conducteur
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10 hidden-phone">Compagnie</th>
                                                <th class="t5 hidden-phone">Usage</th>
                                                <th class="t10">Formul<span class="hidden-phone">Individ</span></th>
                                                <th class="t10">CapitDeces</th>
                                                <th class="t10">CapitInvalidite</th>
                                                <th class="t10">MntFrais</th>
                                                <th class="t10 hidden-phone">PrimeNette</th>
                                                <th class="t5 hidden-phone">%Taxe</th>
                                                <th class="t10 hidden-phone">AccessoireIndividuel</th>
                                                <th class="t5 hidden-phone">%Commission</th>
                                                <th class="t5 hidden-phone">%TPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $individuelConducteursNumber != 0 ) { 
                                            foreach ( $individuelConducteurs as $individuelConducteur ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteIndividuelConducteur<?= $individuelConducteur->id() ?>" data-toggle="modal" data-id="<?= $individuelConducteur->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateIndividuelConducteur<?= $individuelConducteur->id() ?>" data-toggle="modal" data-id="<?= $individuelConducteur->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $individuelConducteur->codeCompagnie() ?></td>
                                                <td class="hidden-phone"><?= $individuelConducteur->codeUsage() ?></td>
                                                <td><?= $individuelConducteur->formuleIndividuel() ?></td>
                                                <td><?= number_format($individuelConducteur->capitalDeces(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($individuelConducteur->capitalInvalidite(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($individuelConducteur->montantFrais(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($individuelConducteur->primeNette(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($individuelConducteur->tauxTaxe(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($individuelConducteur->accessoireIndividuel(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($individuelConducteur->tauxCommission(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($individuelConducteur->tauxTPS(), 2, ',', ' ') ?></td>
                                            </tr> 
                                            <!-- updateIndividuelConducteur box begin -->
                                            <div id="updateIndividuelConducteur<?= $individuelConducteur->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Individuel Conducteur</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $individuelConducteur->codeCompagnie() ?>"><?= $individuelConducteur->codeCompagnie() ?></option>
                                                                    <?php foreach ( $compagnies as $compagnie ) { ?>
                                                                    <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Usage</label>
                                                            <div class="controls">
                                                                <select name="codeUsage">
                                                                    <option value="<?= $individuelConducteur->codeUsage() ?>"><?= $individuelConducteur->codeUsage() ?></option>
                                                                    <option disabled="disabled">----------------------------</option>
                                                                    <?php foreach ( $usages as $usage ) { ?>
                                                                    <option value="<?= $usage->code() ?>"><?= $usage->code() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Formule Individuel</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formuleIndividuel"  value="<?= $individuelConducteur->formuleIndividuel() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Capital Deces</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="capitalDeces"  value="<?= $individuelConducteur->capitalDeces() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Capital Invalidite</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="capitalInvalidite"  value="<?= $individuelConducteur->capitalInvalidite() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Montant Frais</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montantFrais"  value="<?= $individuelConducteur->montantFrais() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prime Nette</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeNette"  value="<?= $individuelConducteur->primeNette() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux Taxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $individuelConducteur->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Accessoire Individuel</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="accessoireIndividuel"  value="<?= $individuelConducteur->accessoireIndividuel() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux Commission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $individuelConducteur->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux TPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $individuelConducteur->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $individuelConducteur->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="individuelConducteur" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateIndividuelConducteur box end --> 
                                            <!-- deleteIndividuelConducteur box begin -->
                                            <div id="deleteIndividuelConducteur<?= $individuelConducteur->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer IndividuelConducteur</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Individuel Conducteur : <?= $individuelConducteur->id() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $individuelConducteur->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="individuelConducteur" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteIndividuelConducteur box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($individuelConducteursNumber != 0){ echo $pagination; }*/ ?><br>
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

<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $fractionPrimeRCActionController = new AppController('fractionPrimeRC');
    $compagnieActionController       = new AppController('compagnie');
    //objects and vars
    $compagnies       = $compagnieActionController->getAll();
    $fractionPrimeRCs = $fractionPrimeRCActionController->getAll(); 
    /*$fractionPrimeRCsNumber = $fractionPrimeRCActionController->getAllNumber(); 
    $p = 1;
    if ( $fractionPrimeRCsNumber != 0 ) {
        $fractionPrimeRCPerPage = 20;
        $pageNumber = ceil($fractionPrimeRCsNumber/$fractionPrimeRCPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $fractionPrimeRCPerPage;
        $pagination = paginate('fractionPrimeRC.php', '?p=', $pageNumber, $p);
        $fractionPrimeRCs = $fractionPrimeRCActionController->getAllByLimits($begin, $fractionPrimeRCPerPage);
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
                                <li><i class="icon-th"></i><a>Fractions Prime RC</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addFractionPrimeRC box begin -->
                            <div id="addFractionPrimeRC" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Fraction Prime RC</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">Code Compagnie</label>
                                            <div class="controls">
                                                <select name="codeCompagnie">
                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">NombreMois</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nombreMois" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TauxMois</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxMois" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="fractionPrimeRC" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addFractionPrimeRC box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Fractions Prime RC</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addFractionPrimeRC" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Fraction Prime RC
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t70">Compagnie</th>
                                                <th class="t10">Nombre Mois</th>
                                                <th class="t10">Taux Mois</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $fractionPrimeRCsNumber != 0 ) { 
                                            foreach ( $fractionPrimeRCs as $fractionPrimeRC ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteFractionPrimeRC<?= $fractionPrimeRC->id() ?>" data-toggle="modal" data-id="<?= $fractionPrimeRC->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateFractionPrimeRC<?= $fractionPrimeRC->id() ?>" data-toggle="modal" data-id="<?= $fractionPrimeRC->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $fractionPrimeRC->codeCompagnie()." : ".$compagnieActionController->getOneById($fractionPrimeRC->codeCompagnie())->raisonSociale() ?></td>
                                                <td><?= $fractionPrimeRC->nombreMois() ?></td>
                                                <td><?= number_format($fractionPrimeRC->tauxMois(), 2, ',', ' ') ?></td>
                                            </tr> 
                                            <!-- updateFractionPrimeRC box begin -->
                                            <div id="updateFractionPrimeRC<?= $fractionPrimeRC->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info FractionPrimeRC</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">CodeCompagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                <option value="<?= $fractionPrimeRC->codeCompagnie() ?>"><?= $fractionPrimeRC->codeCompagnie()." : ".$compagnieActionController->getOneById($fractionPrimeRC->codeCompagnie())->raisonSociale() ?></option>
                                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NombreMois</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nombreMois"  value="<?= $fractionPrimeRC->nombreMois() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxMois</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxMois"  value="<?= $fractionPrimeRC->tauxMois() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $fractionPrimeRC->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="fractionPrimeRC" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteFractionPrimeRC box begin -->
                                            <div id="deleteFractionPrimeRC<?= $fractionPrimeRC->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer FractionPrimeRC</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer FractionPrimeRC : <?= $fractionPrimeRC->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $fractionPrimeRC->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="fractionPrimeRC" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteClasse box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($fractionPrimeRCsNumber != 0){ echo $pagination; }*/ ?><br>
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

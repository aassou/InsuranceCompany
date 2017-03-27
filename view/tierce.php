<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $tierceActionController = new AppController('tierce');
    $compagnieActionController = new AppController('compagnie');
    $usageActionController = new AppController('usage');
    $classeActionController = new AppController('classe');
    $sousClasseActionController = new AppController('sousClasse');
    //objects and vars
    $compagnies = $compagnieActionController->getAll();
    $usages = $usageActionController->getAll();
    $classes = $classeActionController->getAll();
    $sousClasses = $sousClasseActionController->getAll();
    $tierces = $tierceActionController->getAll(); 
    /*$tiercesNumber = $tierceActionController->getAllNumber(); 
    $p = 1;
    if ( $tiercesNumber != 0 ) {
        $tiercePerPage = 20;
        $pageNumber = ceil($tiercesNumber/$tiercePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $tiercePerPage;
        $pagination = paginate('tierce.php', '?p=', $pageNumber, $p);
        $tierces = $tierceActionController->getAllByLimits($begin, $tiercePerPage);
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
                                <li><i class="icon-reorder"></i><a>Tierce</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addTierce box begin -->
                            <div id="addTierce" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Tierce</h3>
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
                                            <label class="control-label">Classe</label>
                                            <div class="controls">
                                                <select name="codeClasse" id="codeClasse">
                                                <?php foreach ( $classes as $classe ) { ?>
                                                <option value="<?= $classe->code() ?>"><?= $classe->code() ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Sous-Classe</label>
                                            <div class="controls">
                                                <select name="codeSousClasse" id="codeSousClasse">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">FormuleTierce</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formuleTierce" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeFixe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeFixe" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TauxVehiculeNeuf</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxVehiculeNeuf" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">MajorationRemorque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="majorationRemorque" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TauxCommission</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxCommission" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TauxTPS</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxTPS" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TauxTaxe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxTaxe" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TauxFranchise</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxFranchise" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">MontantFranchise</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="montantFranchise" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Observation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="observation" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="tierce" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addTierce box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Tierces</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addTierce" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Tierce
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t5 hidden-phone">Compa</th>
                                                <th class="t5">Usage</th>
                                                <th class="t5">Clas</th>
                                                <th class="t5 hidden-phone">SClas</th>
                                                <th class="t5">FrmlTierc</th>
                                                <th class="t10 hidden-phone">PrimeFixe</th>
                                                <th class="t10">%VehNeuf</th>
                                                <th class="t10 hidden-phone">MajRmorq</th>
                                                <th class="t5 hidden-phone">%Commi</th>
                                                <th class="t5 hidden-phone">%TPS</th>
                                                <th class="t5 hidden-phone">%Taxe</th>
                                                <th class="t10">%Frnchise</th>
                                                <th class="t5">MntFrnchs</th>
                                                <th class="t5 hidden-phone">Observ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $tiercesNumber != 0 ) { 
                                            foreach ( $tierces as $tierce ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteTierce<?= $tierce->id() ?>" data-toggle="modal" data-id="<?= $tierce->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateTierce<?= $tierce->id() ?>" data-toggle="modal" data-id="<?= $tierce->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $tierce->codeCompagnie() ?></td>
                                                <td><?= $tierce->codeUsage() ?></td>
                                                <td><?= $tierce->codeClasse() ?></td>
                                                <td class="hidden-phone"><?= $tierce->codeSousClasse() ?></td>
                                                <td><?= $tierce->formuleTierce() ?></td>
                                                <td class="hidden-phone"><?= $tierce->primeFixe() ?></td>
                                                <td><?= $tierce->tauxVehiculeNeuf() ?></td>
                                                <td class="hidden-phone"><?= $tierce->majorationRemorque() ?></td>
                                                <td class="hidden-phone"><?= $tierce->tauxCommission() ?></td>
                                                <td class="hidden-phone"><?= $tierce->tauxTPS() ?></td>
                                                <td class="hidden-phone"><?= $tierce->tauxTaxe() ?></td>
                                                <td><?= $tierce->tauxFranchise() ?></td>
                                                <td><?= $tierce->montantFranchise() ?></td>
                                                <td class="hidden-phone"><?= $tierce->observation() ?></td>
                                            </tr> 
                                            <!-- updateTierce box begin -->
                                            <div id="updateTierce<?= $tierce->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Tierce</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">CodeCompagnie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeCompagnie"  value="<?= $tierce->codeCompagnie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeUsage</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeUsage"  value="<?= $tierce->codeUsage() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeClasse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeClasse"  value="<?= $tierce->codeClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeSousClasse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeSousClasse"  value="<?= $tierce->codeSousClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">FormuleTierce</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formuleTierce"  value="<?= $tierce->formuleTierce() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeFixe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeFixe"  value="<?= $tierce->primeFixe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxVehiculeNeuf</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxVehiculeNeuf"  value="<?= $tierce->tauxVehiculeNeuf() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MajorationRemorque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="majorationRemorque"  value="<?= $tierce->majorationRemorque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $tierce->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $tierce->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $tierce->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxFranchise</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxFranchise"  value="<?= $tierce->tauxFranchise() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MontantFranchise</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montantFranchise"  value="<?= $tierce->montantFranchise() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Observation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="observation"  value="<?= $tierce->observation() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $tierce->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="tierce" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteTierce box begin -->
                                            <div id="deleteTierce<?= $tierce->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Tierce</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Tierce : <?= $tierce->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $tierce->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="tierce" />    
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
                                    <?php /*if($tiercesNumber != 0){ echo $pagination; }*/ ?><br>
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

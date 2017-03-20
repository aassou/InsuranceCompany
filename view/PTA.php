<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $PTAActionController = new PTAActionController('PTA');
    $compagnieActionController = new CompagnieActionController('compagnie');
    $usageActionController = new UsageManager('usage');
    //get objects
    $compagnies = $compagnieActionController->getCompagnies();
    $usages = $usageActionController->getUsages();
    $PTAs = $PTAActionController->getPTAs(); 
    /*$PTAsNumber = $PTAActionController->getPTAsNumber(); 
    $p = 1;
    if ( $PTAsNumber != 0 ) {
        $PTAPerPage = 20;
        $pageNumber = ceil($PTAsNumber/$PTAPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $PTAPerPage;
        $pagination = paginate('PTA.php', '?p=', $pageNumber, $p);
        $PTAs = $PTAActionController->getPTAsByLimits($begin, $PTAPerPage);
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
                                <li><i class="icon-road"></i><a>PTA</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addPTA box begin -->
                            <div id="addPTA" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter PTA</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Compagnie</label>
                                            <div class="controls">
                                                <select name="codeCompagnie">
                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnieManager->getCompagnieById($compagnie->id())->raisonSociale() ?></option>
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
                                            <label class="control-label">Formule PTA</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formulePTA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nombre Place</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nombrePlace" />
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
                                            <label class="control-label">Accessoire PTA</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="accessoirePTA" />
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
                                                <input type="hidden" name="source" value="PTA" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addPTA box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des PTAs</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addPTA" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;PTA
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10 hidden-phone">Compagnie</th>
                                                <th class="t5 hidden-phone">Usage</th>
                                                <th class="t10">FormPTA</th>
                                                <th class="t5">NbrPlace</th>
                                                <th class="t10">CapDeces</th>
                                                <th class="t10">CapInvali</th>
                                                <th class="t10 hidden-phone">MntFrais</th>
                                                <th class="t10 hidden-phone">PrimeNette</th>
                                                <th class="t5 hidden-phone">%Taxe</th>
                                                <th class="t5 hidden-phone">AccessoPTA</th>
                                                <th class="t5 hidden-phone">%Commission</th>
                                                <th class="t5 hidden-phone">%TPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $PTAsNumber != 0 ) { 
                                            foreach ( $PTAs as $PTA ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deletePTA<?= $PTA->id() ?>" data-toggle="modal" data-id="<?= $PTA->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updatePTA<?= $PTA->id() ?>" data-toggle="modal" data-id="<?= $PTA->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $PTA->codeCompagnie() ?></td>
                                                <td class="hidden-phone"><?= $PTA->codeUsage() ?></td>
                                                <td><?= $PTA->formulePTA() ?></td>
                                                <td><?= $PTA->nombrePlace() ?></td>
                                                <td><?= number_format($PTA->capitalDeces(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($PTA->capitalInvalidite(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($PTA->montantFrais(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($PTA->primeNette(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($PTA->tauxTaxe(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($PTA->accessoirePTA(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($PTA->tauxCommission(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($PTA->tauxTPS(), 2, ',', ' ') ?></td>
                                            </tr> 
                                            <!-- updatePTA box begin -->
                                            <div id="updatePTA<?= $PTA->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info PTA</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $PTA->codeCompagnie() ?>"><?= $PTA->codeCompagnie() ?></option>
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
                                                                    <option value="<?= $PTA->codeUsage() ?>"><?= $PTA->codeUsage() ?></option>
                                                                    <option disabled="disabled">----------------------------</option>
                                                                    <?php foreach ( $usages as $usage ) { ?>
                                                                    <option value="<?= $usage->code() ?>"><?= $usage->code() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">FormulePTA</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formulePTA"  value="<?= $PTA->formulePTA() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NombrePlace</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nombrePlace"  value="<?= $PTA->nombrePlace() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CapitalDeces</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="capitalDeces"  value="<?= $PTA->capitalDeces() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CapitalInvalidite</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="capitalInvalidite"  value="<?= $PTA->capitalInvalidite() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MontantFrais</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montantFrais"  value="<?= $PTA->montantFrais() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeNette</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeNette"  value="<?= $PTA->primeNette() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $PTA->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">AccessoirePTA</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="accessoirePTA"  value="<?= $PTA->accessoirePTA() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $PTA->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $PTA->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idPTA" value="<?= $PTA->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="PTA" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deletePTA box begin -->
                                            <div id="deletePTA<?= $PTA->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer PTA</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer PTA : <?= $PTA->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idPTA" value="<?= $PTA->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="PTA" />    
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
                                    <?php /*if($PTAsNumber != 0){ echo $pagination; }*/ ?><br>
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

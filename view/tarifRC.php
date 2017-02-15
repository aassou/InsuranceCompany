<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    $tarifRCManager = new TarifRCManager(PDOFactory::getMysqlConnection());
    $tarifRCNumber = $tarifRCManager->getTarifRCsNumber(); 
    $p = 1;
    if($tarifRCNumber!=0){
        $tarifRCPerPage = 20;
        $pageNumber = ceil($tarifRCNumber/$tarifRCPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $tarifRCPerPage;
        $pagination = paginate('tarifRC.php', '?p=', $pageNumber, $p);
        $tarifRCs = $tarifRCManager->getTarifRCsByLimits($begin, $tarifRCPerPage);
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
                                <li><i class="icon-wrench"></i><a href="configuration.php">Paramètrages</a><i class="icon-angle-right"></i></li>
                                <li><i class="icon-barcode"></i><a>Tarifs RC</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addTarifRC box begin -->
                            <div id="addTarifRC" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter TarifRC</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">CodeCompagnie</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeCompagnie" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">CodeUsage</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeUsage" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">CodeClasse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeClasse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">CodeSousClasse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeSousClasse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Carburant</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="carburant" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PuissanceFiscale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="puissanceFiscale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeRC</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeRC" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">MajorationRemorque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="majorationRemorque" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">MatiereInflamable</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="matiereInflamable" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TransportPersonne</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="transportPersonne" />
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
                                            <label class="control-label">Timbre</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="timbre" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="tarifRC" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addTarifRC box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des TarifRCs</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addTarifRC" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;TarifRC
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="hidden-phone t10">Actions</th>
                                                <th class="t10">Compagnie</th>
                                                <th class="t10">Usage</th>
                                                <th class="t10">Classe</th>
                                                <th class="t10">S-Classe</th>
                                                <th class="t10">Carburant</th>
                                                <th class="t10">PFisc</th>
                                                <th class="t10">PrimeRC</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ( $tarifRCNumber != 0 ) { 
                                            foreach ( $tarifRCs as $tarifRC ) { ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteTarifRC<?= $tarifRC->id() ?>" data-toggle="modal" data-id="<?= $tarifRC->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateTarifRC<?= $tarifRC->id() ?>" data-toggle="modal" data-id="<?= $tarifRC->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $tarifRC->codeCompagnie() ?></td>
                                                <td><?= $tarifRC->codeUsage() ?></td>
                                                <td><?= $tarifRC->codeClasse() ?></td>
                                                <td><?= $tarifRC->codeSousClasse() ?></td>
                                                <td><?= $tarifRC->carburant() ?></td>
                                                <td><?= $tarifRC->puissanceFiscale() ?></td>
                                                <td><?= $tarifRC->primeRC() ?></td>
                                            </tr> 
                                            <!-- updateTarifRC box begin -->
                                            <div id="updateTarifRC<?= $tarifRC->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info TarifRC</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">CodeCompagnie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeCompagnie"  value="<?= $tarifRC->codeCompagnie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeUsage</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeUsage"  value="<?= $tarifRC->codeUsage() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeClasse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeClasse"  value="<?= $tarifRC->codeClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeSousClasse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeSousClasse"  value="<?= $tarifRC->codeSousClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Carburant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="carburant"  value="<?= $tarifRC->carburant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PuissanceFiscale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="puissanceFiscale"  value="<?= $tarifRC->puissanceFiscale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeRC</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeRC"  value="<?= $tarifRC->primeRC() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MajorationRemorque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="majorationRemorque"  value="<?= $tarifRC->majorationRemorque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MatiereInflamable</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="matiereInflamable"  value="<?= $tarifRC->matiereInflamable() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TransportPersonne</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="transportPersonne"  value="<?= $tarifRC->transportPersonne() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $tarifRC->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $tarifRC->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $tarifRC->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Timbre</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="timbre"  value="<?= $tarifRC->timbre() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idTarifRC" value="<?= $tarifRC->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="tarifRC" />
                                                                <input type="hidden" name="pageNumber" value="<?= $p ?>" />     
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteTarifRC box begin -->
                                            <div id="deleteTarifRC<?= $tarifRC->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer TarifRC</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer TarifRC : <?= $tarifRC->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idTarifRC" value="<?= $tarifRC->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="tarifRC" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteClasse box end --> 
                                            <?php }//end foreach
                                            }//end if?>
                                        </tbody>
                                    </table>
                                    <?php if($tarifRCNumber != 0){ echo $pagination; } ?><br>
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

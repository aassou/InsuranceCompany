<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $tarifRCActionController = new TarifRCActionController('tarifRC');
    $compagnieActionController = new CompagnieActionController('compagnie');
    $usageActionController = new UsageActionController('usage');
    $classeActionController = new ClasseActionController('classe');
    $sousClasseActionController = new SousClasseActionController('sousClasse');
    //objects and vars
    $compagnies = $compagnieActionController->getCompagnies();
    $usages = $usageActionController->getUsages();
    $classes = $classeActionController->getClasses();
    //set pagination
    $tarifRCNumber = $tarifRCActionController->getTarifRCsNumber(); 
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
        $tarifRCs = $tarifRCActionController->getTarifRCsByLimits($begin, $tarifRCPerPage);
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
                                            <label class="control-label">Classe</label>
                                            <div class="controls">
                                                <select name="codeClasse" id="codeClasse" onchange="getSousClasse('')">
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
                                            <label class="control-label">Carburant</label>
                                            <div class="controls">
                                                <select name="carburant">
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Puissance Fiscale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="puissanceFiscale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nombre Place</label>
                                            <div class="controls">
                                                <input type="text" name="nombrePlace" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tonnage</label>
                                            <div class="controls">
                                                <input type="text" name="tonnage" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prime RC</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeRC" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Majoration Remorque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="majorationRemorque" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Matiere Inflamable</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="matiereInflamable" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Transport Personne</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="transportPersonne" />
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
                                        <div class="control-group">
                                            <label class="control-label">Taux Taxe</label>
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
                                                <input type="hidden" name="pageNumber" value="<?= $p ?>" />   
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
                                    <h4>Liste des Tarifs RC</h4>
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
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t30 hidden-phone">Compagnie</th>
                                                <th class="t5">Usage</th>
                                                <th class="t5">Classe</th>
                                                <th class="t10 hidden-phone">S-Classe</th>
                                                <th class="t5">Carburant</th>
                                                <th class="t5">PFisc</th>
                                                <th class="t10">PrimeRC</th>
                                                <th class="t5">MajRemrq</th>
                                                <th class="t5">MatInfl</th>
                                                <th class="t5">TransPers</th>
                                                <th class="t5">%Commiss</th>
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
                                                <td class="hidden-phone"><?= $tarifRC->codeCompagnie()." : ".$compagnieManager->getCompagnieById($tarifRC->codeCompagnie())->raisonSociale() ?></td>
                                                <td><?= $tarifRC->codeUsage() ?></td>
                                                <td><?= $tarifRC->codeClasse() ?></td>
                                                <td class="hidden-phone"><?= $tarifRC->codeSousClasse() ?></td>
                                                <td><?= $tarifRC->carburant() ?></td>
                                                <td><?= $tarifRC->puissanceFiscale() ?></td>
                                                <td><?= number_format($tarifRC->primeRC(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifRC->majorationRemorque(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifRC->matiereInflamable(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifRC->transportPersonne(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifRC->tauxCommission(), 2, ',', ' ') ?></td>
                                            </tr> 
                                            <!-- updateTarifRC box begin -->
                                            <div id="updateTarifRC<?= $tarifRC->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Tarif RC</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $tarifRC->codeCompagnie() ?>"><?= $tarifRC->codeCompagnie()." : ".$compagnieManager->getCompagnieById($tarifRC->codeCompagnie())->raisonSociale() ?></option>
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
                                                                    <option value="<?= $tarifRC->codeUsage() ?>"><?= $tarifRC->codeUsage() ?></option>
                                                                    <option disabled="disabled">----------------------------</option>
                                                                    <?php foreach ( $usages as $usage ) { ?>
                                                                    <option value="<?= $usage->code() ?>"><?= $usage->code() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Classe</label>
                                                            <div class="controls">
                                                                <select name="codeClasse" id="codeClasse<?= $tarifRC->id() ?>" onchange="getSousClasse(<?= $tarifRC->id() ?>)">
                                                                    <option value="<?= $tarifRC->codeClasse() ?>"><?= $tarifRC->codeClasse() ?></option>
                                                                    <option disabled="disabled">----------------------------</option>
                                                                    <?php foreach ( $classes as $classe ) { ?>
                                                                    <option value="<?= $classe->code() ?>"><?= $classe->code() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Sous-Classe</label>
                                                            <div class="controls">
                                                                <select name="codeSousClasse" id="codeSousClasse<?= $tarifRC->id() ?>">
                                                                    <option value="<?= $tarifRC->codeSousClasse() ?>"><?= $tarifRC->codeSousClasse() ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Carburant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="carburant"  value="<?= $tarifRC->carburant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Puissance Fiscale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="puissanceFiscale" value="<?= $tarifRC->puissanceFiscale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Nombre Place</label>
                                                            <div class="controls">
                                                                <input type="text" name="nombrePlace" value="<?= $tarifRC->nombrePlace() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tonnage</label>
                                                            <div class="controls">
                                                                <input type="text" name="tonnage" value="<?= $tarifRC->tonnage() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prime RC</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeRC"  value="<?= $tarifRC->primeRC() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Majoration Remorque</label>
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
                                                            <label class="control-label">Transport Personne</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="transportPersonne"  value="<?= $tarifRC->transportPersonne() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux Commission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $tarifRC->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux TPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $tarifRC->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux Taxe</label>
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
                                                    <h3>Supprimer Tarif RC</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Tarif RC : <?= $tarifRC->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idTarifRC" value="<?= $tarifRC->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="tarifRC" />    
                                                                <input type="hidden" name="pageNumber" value="<?= $p ?>" />     
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

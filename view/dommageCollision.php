<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $dommageCollisionActionController = new DommageCollisionActionController('dommageCollision');
    $compagnieActionController = new CompagnieActionController('compagnie');
    $usageActionController = new UsageActionController('usage');
    $classeActionController = new ClasseActionController('classe');
    $sousClasseActionController = new SousClasseActionController('sousClasse');
    //objects and vars
    $dommageCollisions = $dommageCollisionActionController->getDommageCollisions();
    $compagnies = $compagnieActionController->getCompagnies();
    $usages = $usageActionController->getUsages();
    $classes = $classeActionController->getClasses();  
    /*$dommageCollisionsNumber = $dommageCollisionActionController->getDommageCollisionsNumber(); 
    $p = 1;
    if ( $dommageCollisionsNumber != 0 ) {
        $dommageCollisionPerPage = 20;
        $pageNumber = ceil($dommageCollisionsNumber/$dommageCollisionPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $dommageCollisionPerPage;
        $pagination = paginate('dommageCollision.php', '?p=', $pageNumber, $p);
        $dommageCollisions = $dommageCollisionActionController->getDommageCollisionsByLimits($begin, $dommageCollisionPerPage);
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
                                <li><i class="icon-warning-sign"></i><a>Dommage et collisions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addDommageCollision box begin -->
                            <div id="addDommageCollision" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter DommageCollision</h3>
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
                                                <input required="required" type="text" name="carburant" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Puissance Fiscale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="puissanceFiscale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Formule Collision</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formuleCollision" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prime Fixe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeFixe" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Franchise</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="franchise" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Plafond</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="plafond" />
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
                                                <input type="hidden" name="source" value="dommageCollision" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addDommageCollision box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Dommages et Collisions</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addDommageCollision" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Dommage Collision
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">Compagnie</th>
                                                <th class="t10">Usage</th>
                                                <th class="t5">Classe</th>
                                                <th class="t5">SClasse</th>
                                                <th class="t5">Carbur</th>
                                                <th class="t10">PFiscale</th>
                                                <th class="t10">FormCollision</th>
                                                <th class="t10">PrimeFixe</th>
                                                <th class="t10">Franchise</th>
                                                <th class="t10">Plafond</th>
                                                <th class="t5">%Commiss</th>
                                                <th class="t5">%TPS</th>
                                                <th class="t5">%Taxe</th>
                                                <th class="t10">Observation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $dommageCollisionsNumber != 0 ) { 
                                            foreach ( $dommageCollisions as $dommageCollision ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteDommageCollision<?= $dommageCollision->id() ?>" data-toggle="modal" data-id="<?= $dommageCollision->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateDommageCollision<?= $dommageCollision->id() ?>" data-toggle="modal" data-id="<?= $dommageCollision->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $dommageCollision->codeCompagnie().": ".$compagnieManager->getCompagnieById($dommageCollision->codeCompagnie())->raisonSocialeAbrege() ?></td>
                                                <td><?= $dommageCollision->codeUsage() ?></td>
                                                <td><?= $dommageCollision->codeClasse() ?></td>
                                                <td><?= $dommageCollision->codeSousClasse() ?></td>
                                                <td><?= $dommageCollision->carburant() ?></td>
                                                <td><?= $dommageCollision->puissanceFiscale() ?></td>
                                                <td><?= $dommageCollision->formuleCollision() ?></td>
                                                <td><?= $dommageCollision->primeFixe() ?></td>
                                                <td><?= $dommageCollision->franchise() ?></td>
                                                <td><?= $dommageCollision->plafond() ?></td>
                                                <td><?= $dommageCollision->tauxCommission() ?></td>
                                                <td><?= $dommageCollision->tauxTPS() ?></td>
                                                <td><?= $dommageCollision->tauxTaxe() ?></td>
                                                <td><?= $dommageCollision->observation() ?></td>
                                            </tr> 
                                            <!-- updateDommageCollision box begin -->
                                            <div id="updateDommageCollision<?= $dommageCollision->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info DommageCollision</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $dommageCollision->codeCompagnie() ?>"><?= $dommageCollision->codeCompagnie()." : ".$compagnieManager->getCompagnieById($dommageCollision->codeCompagnie())->raisonSociale() ?></option>
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
                                                                    <option value="<?= $dommageCollision->codeUsage() ?>"><?= $dommageCollision->codeUsage() ?></option>
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
                                                                <select name="codeClasse" id="codeClasse<?= $dommageCollision->id() ?>" onchange="getSousClasse(<?= $dommageCollision->id() ?>)">
                                                                    <option value="<?= $dommageCollision->codeClasse() ?>"><?= $dommageCollision->codeClasse() ?></option>
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
                                                                <select name="codeSousClasse" id="codeSousClasse<?= $dommageCollision->id() ?>">
                                                                    <option value="<?= $dommageCollision->codeSousClasse() ?>"><?= $dommageCollision->codeSousClasse() ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Carburant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="carburant"  value="<?= $dommageCollision->carburant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PuissanceFiscale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="puissanceFiscale"  value="<?= $dommageCollision->puissanceFiscale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">FormuleCollision</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formuleCollision"  value="<?= $dommageCollision->formuleCollision() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeFixe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeFixe"  value="<?= $dommageCollision->primeFixe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Franchise</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="franchise"  value="<?= $dommageCollision->franchise() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Plafond</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="plafond"  value="<?= $dommageCollision->plafond() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $dommageCollision->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $dommageCollision->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $dommageCollision->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Observation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="observation"  value="<?= $dommageCollision->observation() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idDommageCollision" value="<?= $dommageCollision->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="dommageCollision" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteDommageCollision box begin -->
                                            <div id="deleteDommageCollision<?= $dommageCollision->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer DommageCollision</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer DommageCollision : <?= $dommageCollision->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idDommageCollision" value="<?= $dommageCollision->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="dommageCollision" />    
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
                                    <?php /*if($dommageCollisionsNumber != 0){ echo $pagination; }*/ ?><br>
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

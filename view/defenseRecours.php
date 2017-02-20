<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //get Managers
    $defenseRecoursManager = new DefenseRecoursManager(PDOFactory::getMysqlConnection());
    $compagnieManager = new CompagnieManager(PDOFactory::getMysqlConnection());
    $usageManager = new UsageManager(PDOFactory::getMysqlConnection());
    $classeManager = new ClasseManager(PDOFactory::getMysqlConnection());
    $sousClasseManager = new SousClasseManager(PDOFactory::getMysqlConnection());
    //get objects
    $defenseRecourss = $defenseRecoursManager->getDefenseRecourss();
    $compagnies = $compagnieManager->getCompagnies();
    $usages = $usageManager->getUsages();
    $classes = $classeManager->getClasses(); 
    /*$defenseRecourssNumber = $defenseRecoursManager->getDefenseRecourssNumber(); 
    $p = 1;
    if ( $defenseRecourssNumber != 0 ) {
        $defenseRecoursPerPage = 20;
        $pageNumber = ceil($defenseRecourssNumber/$defenseRecoursPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $defenseRecoursPerPage;
        $pagination = paginate('defenseRecours.php', '?p=', $pageNumber, $p);
        $defenseRecourss = $defenseRecoursManager->getDefenseRecourssByLimits($begin, $defenseRecoursPerPage);
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
                                <li><i class="icon-legal"></i><a>Défense et recours</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addDefenseRecours box begin -->
                            <div id="addDefenseRecours" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter DefenseRecours</h3>
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
                                            <label class="control-label">Puissance Fiscale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="puissanceFiscale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Type Defense</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="typeDefense" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Valeur Defense</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="valeurDefense" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Formule Defense</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formuleDefense" />
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
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="defenseRecours" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addDefenseRecours box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Défenses et Recours</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addDefenseRecours" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Défense Recours
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">Compagnie</th>
                                                <th class="t5">Usage</th>
                                                <th class="t5">Classe</th>
                                                <th class="t10">Sous Classe</th>
                                                <th class="t10">PFiscale</th>
                                                <th class="t10">TypeDefense</th>
                                                <th class="t15">Valeur Defense</th>
                                                <th class="t10">FormuDefense</th>
                                                <th class="t5">%Commission</th>
                                                <th class="t5">%TPS</th>
                                                <th class="t5">%Taxe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $defenseRecourssNumber != 0 ) { 
                                            foreach ( $defenseRecourss as $defenseRecours ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteDefenseRecours<?= $defenseRecours->id() ?>" data-toggle="modal" data-id="<?= $defenseRecours->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateDefenseRecours<?= $defenseRecours->id() ?>" data-toggle="modal" data-id="<?= $defenseRecours->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $defenseRecours->codeCompagnie().": ".$compagnieManager->getCompagnieById($defenseRecours->codeCompagnie())->raisonSocialeAbrege() ?></td>
                                                <td><?= $defenseRecours->codeUsage() ?></td>
                                                <td><?= $defenseRecours->codeClasse() ?></td>
                                                <td><?= $defenseRecours->codeSousClasse() ?></td>
                                                <td><?= $defenseRecours->puissanceFiscale() ?></td>
                                                <td><?= $defenseRecours->typeDefense() ?></td>
                                                <td><?= $defenseRecours->valeurDefense() ?></td>
                                                <td><?= $defenseRecours->formuleDefense() ?></td>
                                                <td><?= $defenseRecours->tauxCommission() ?></td>
                                                <td><?= $defenseRecours->tauxTPS() ?></td>
                                                <td><?= $defenseRecours->tauxTaxe() ?></td>
                                            </tr> 
                                            <!-- updateDefenseRecours box begin -->
                                            <div id="updateDefenseRecours<?= $defenseRecours->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info DefenseRecours</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $defenseRecours->codeCompagnie() ?>"><?= $defenseRecours->codeCompagnie()." : ".$compagnieManager->getCompagnieById($defenseRecours->codeCompagnie())->raisonSociale() ?></option>
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
                                                                    <option value="<?= $defenseRecours->codeUsage() ?>"><?= $defenseRecours->codeUsage() ?></option>
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
                                                                <select name="codeClasse" id="codeClasse<?= $defenseRecours->id() ?>" onchange="getSousClasse(<?= $defenseRecours->id() ?>)">
                                                                    <option value="<?= $defenseRecours->codeClasse() ?>"><?= $defenseRecours->codeClasse() ?></option>
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
                                                                <select name="codeSousClasse" id="codeSousClasse<?= $defenseRecours->id() ?>">
                                                                    <option value="<?= $defenseRecours->codeSousClasse() ?>"><?= $defenseRecours->codeSousClasse() ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PuissanceFiscale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="puissanceFiscale"  value="<?= $defenseRecours->puissanceFiscale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TypeDefense</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="typeDefense"  value="<?= $defenseRecours->typeDefense() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">ValeurDefense</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="valeurDefense"  value="<?= $defenseRecours->valeurDefense() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">FormuleDefense</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formuleDefense"  value="<?= $defenseRecours->formuleDefense() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $defenseRecours->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $defenseRecours->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $defenseRecours->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idDefenseRecours" value="<?= $defenseRecours->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="defenseRecours" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteDefenseRecours box begin -->
                                            <div id="deleteDefenseRecours<?= $defenseRecours->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer DefenseRecours</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer DefenseRecours : <?= $defenseRecours->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idDefenseRecours" value="<?= $defenseRecours->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="defenseRecours" />    
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
                                    <?php /*if($defenseRecourssNumber != 0){ echo $pagination; }*/ ?><br>
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

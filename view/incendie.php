<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $incendieActionController = new IncendieActionController('incendie');
    $compagnieActionController = new CompagnieActionController('compagnie');
    $usageActionController = new UsageActionController('uage');
    $classeActionController = new ClasseActionController('classe');
    $sousClasseActionController = new SousClasseActionController('sousClasse');
    //objects and vars
    $incendies = $incendieActionController->getIncendies(); 
    $compagnies = $compagnieActionController->getCompagnies();
    $usages = $usageActionController->getUsages();
    $classes = $classeActionController->getClasses();
    /*$incendiesNumber = $incendieActionController->getIncendiesNumber(); 
    $p = 1;
    if ( $incendiesNumber != 0 ) {
        $incendiePerPage = 20;
        $pageNumber = ceil($incendiesNumber/$incendiePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $incendiePerPage;
        $pagination = paginate('incendie.php', '?p=', $pageNumber, $p);
        $incendies = $incendieActionController->getIncendiesByLimits($begin, $incendiePerPage);
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
                                <li><i class="icon-fire"></i><a>Incendie</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addIncendie box begin -->
                            <div id="addIncendie" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Incendie</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Compagnie</label>
                                            <div class="controls">
                                                <select name="codeCompagnie">
                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnieActionController->getCompagnieById($compagnie->id())->raisonSociale() ?></option>
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
                                            <label class="control-label">Formule Incendie</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formuleIncendie" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux Mille</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxMille" />
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
                                            <label class="control-label">Designation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="designation" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Montant Franchise</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="montantFranchise" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux Franchise</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxFranchise" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Montant</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="montant" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Formule</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="formule" />
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
                                                <input type="hidden" name="source" value="incendie" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addIncendie box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Incendies</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addIncendie" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Incendie
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t5 hidden-phone">Compagnie</th>
                                                <th class="t5 hidden-phone">Usage</th>
                                                <th class="t5">Classe</th>
                                                <th class="t5">SouClas</th>
                                                <th class="t5">FormIncend</th>
                                                <th class="t5 hidden-phone">%Mille</th>
                                                <th class="t10 hidden-phone">%Commission</th>
                                                <th class="t10 hidden-phone">%TPS</th>
                                                <th class="t10 hidden-phone">%Taxe</th>
                                                <th class="t10 hidden-phone">MntFranch</th>
                                                <th class="t5 hidden-phone">%Franch</th>
                                                <th class="t5">Montant</th>
                                                <th class="t5 hidden-phone">Formule</th>
                                                <th class="t5 hidden-phone">Observ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $incendiesNumber != 0 ) { 
                                            foreach ( $incendies as $incendie ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteIncendie<?= $incendie->id() ?>" data-toggle="modal" data-id="<?= $incendie->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateIncendie<?= $incendie->id() ?>" data-toggle="modal" data-id="<?= $incendie->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $incendie->codeCompagnie().": ".$compagnieActionController->getCompagnieById($incendie->codeCompagnie())->raisonSocialeAbrege() ?></td>
                                                <td class="hidden-phone"><?= $incendie->codeUsage() ?></td>
                                                <td><?= $incendie->codeClasse() ?></td>
                                                <td><?= $incendie->codeSousClasse() ?></td>
                                                <td><?= $incendie->formuleIncendie() ?></td>
                                                <td class="hidden-phone"><?= $incendie->tauxMille() ?></td>
                                                <td class="hidden-phone"><?= $incendie->tauxCommission() ?></td>
                                                <td class="hidden-phone"><?= $incendie->tauxTPS() ?></td>
                                                <td class="hidden-phone"><?= $incendie->tauxTaxe() ?></td>
                                                <td class="hidden-phone"><?= $incendie->montantFranchise() ?></td>
                                                <td class="hidden-phone"><?= $incendie->tauxFranchise() ?></td>
                                                <td class="hidden-phone"><?= $incendie->montant() ?></td>
                                                <td><?= $incendie->formule() ?></td>
                                                <td class="hidden-phone"><?= $incendie->observation() ?></td>
                                            </tr> 
                                            <!-- updateIncendie box begin -->
                                            <div id="updateIncendie<?= $incendie->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Incendie</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $incendie->codeCompagnie() ?>"><?= $incendie->codeCompagnie()." : ".$compagnieActionController->getCompagnieById($incendie->codeCompagnie())->raisonSociale() ?></option>
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
                                                                    <option value="<?= $incendie->codeUsage() ?>"><?= $incendie->codeUsage() ?></option>
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
                                                                <select name="codeClasse" id="codeClasse<?= $incendie->id() ?>" onchange="getSousClasse(<?= $incendie->id() ?>)">
                                                                    <option value="<?= $incendie->codeClasse() ?>"><?= $incendie->codeClasse() ?></option>
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
                                                                <select name="codeSousClasse" id="codeSousClasse<?= $incendie->id() ?>">
                                                                    <option value="<?= $incendie->codeSousClasse() ?>"><?= $incendie->codeSousClasse() ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">FormuleIncendie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formuleIncendie"  value="<?= $incendie->formuleIncendie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxMille</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxMille"  value="<?= $incendie->tauxMille() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $incendie->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $incendie->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTaxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTaxe"  value="<?= $incendie->tauxTaxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Designation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="designation"  value="<?= $incendie->designation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">MontantFranchise</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montantFranchise"  value="<?= $incendie->montantFranchise() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxFranchise</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxFranchise"  value="<?= $incendie->tauxFranchise() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Montant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montant"  value="<?= $incendie->montant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Formule</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="formule"  value="<?= $incendie->formule() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Observation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="observation"  value="<?= $incendie->observation() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idIncendie" value="<?= $incendie->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="incendie" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteIncendie box begin -->
                                            <div id="deleteIncendie<?= $incendie->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Incendie</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Incendie : <?= $incendie->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idIncendie" value="<?= $incendie->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="incendie" />    
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
                                    <?php /*if($incendiesNumber != 0){ echo $pagination; }*/ ?><br>
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

<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $tarifFrontiereActionController = new TarifFrontiereActionController('tarifFrontiere');
    $compagnieActionController = new CompagnieActionController('compagnie');
    $classeActionController = new ClasseActionController('classe');
    $sousClasseActionController = new SousClasseActionController('sousClasse');
    //objects and vars
    $compagnies = $compagnieActionController->getCompagnies();
    $classes = $classeActionController->getClasses(); 
    $tarifFrontieres = $tarifFrontiereActionController->getTarifFrontieres(); 
    /*$tarifFrontieresNumber = $tarifFrontiereActionController->getTarifFrontieresNumber(); 
    $p = 1;
    if ( $tarifFrontieresNumber != 0 ) {
        $tarifFrontierePerPage = 20;
        $pageNumber = ceil($tarifFrontieresNumber/$tarifFrontierePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $tarifFrontierePerPage;
        $pagination = paginate('tarifFrontiere.php', '?p=', $pageNumber, $p);
        $tarifFrontieres = $tarifFrontiereActionController->getTarifFrontieresByLimits($begin, $tarifFrontierePerPage);
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
                                <li><i class="icon-plane"></i><a>Tarifs Frontières</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addTarifFrontiere box begin -->
                            <div id="addTarifFrontiere" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter TarifFrontiere</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Compagnie</label>
                                            <div class="controls">
                                                <select name="codeCompagnie">
                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>
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
                                            <label class="control-label">Designation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="designation" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Periode</label>
                                            <div class="controls">
                                                <input class="span4" required="required" type="text" name="periode" />
                                                <select class="span4" name="typePeriode">
                                                    <option value="Jours">Jours</option>
                                                    <option value="Mois">Mois</option>
                                                    <option value="Ans">Ans</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeRC</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeRC" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taxe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxe" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeDR</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeDR" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TaxeDR</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxeDR" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Timbre</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="timbre" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux Majoration</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxMajoration" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taxe Remorque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxeRemorque" />
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
                                                <input type="hidden" name="source" value="tarifFrontiere" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addTarifFrontiere box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Tarif Frontières</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addTarifFrontiere" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Tarif Frontiere
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t5 hidden-phone">Comp</th>
                                                <th class="t5">Class</th>
                                                <th class="t5 hidden-phone">SClass</th>
                                                <th class="t10">Designat°</th>
                                                <th class="t10">Periode</th>
                                                <th class="t10 hidden-phone">PrimeRC</th>
                                                <th class="t10 hidden-phone">Taxe</th>
                                                <th class="t10 hidden-phone">PrimeDR</th>
                                                <th class="t5 hidden-phone">TaxeDR</th>
                                                <th class="t5 hidden-phone">Timbre</th>
                                                <th class="t10 hidden-phone">%Majorat°</th>
                                                <th class="t5 hidden-phone">TRemorq</th>
                                                <th class="t5 hidden-phone">%Commiss</th>
                                                <th class="t5 hidden-phone">%TPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $tarifFrontieresNumber != 0 ) { 
                                            foreach ( $tarifFrontieres as $tarifFrontiere ) {
                                            ?>
                                            <tr id="row<?= $tarifFrontiere->id() ?>">
                                                <td class="hidden-phone">
                                                    <a href="#deleteTarifFrontiere<?= $tarifFrontiere->id() ?>" data-toggle="modal" data-id="<?= $tarifFrontiere->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateTarifFrontiere<?= $tarifFrontiere->id() ?>" data-toggle="modal" data-id="<?= $tarifFrontiere->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $tarifFrontiere->codeCompagnie().": ".$compagnieActionController->getCompagnieById($tarifFrontiere->codeCompagnie())->raisonSocialeAbrege() ?></td>
                                                <td><?= $tarifFrontiere->codeClasse() ?></td>
                                                <td class="hidden-phone"><?= $tarifFrontiere->codeSousClasse() ?></td>
                                                <td><?= $tarifFrontiere->designation() ?></td>
                                                <td><?= $tarifFrontiere->periode()." ".$tarifFrontiere->typePeriode() ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->primeRC(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->taxe(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->primeDR(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->taxeDR(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->timbre(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->tauxMajoration(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->taxeRemorque(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->tauxCommission(), 2, ',', ' ') ?></td>
                                                <td class="hidden-phone"><?= number_format($tarifFrontiere->tauxTPS(), 2, ',', ' ') ?></td>
                                            </tr> 
                                            <!-- updateTarifFrontiere box begin -->
                                            <div id="updateTarifFrontiere<?= $tarifFrontiere->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info TarifFrontiere</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                <option value="<?= $tarifFrontiere->codeCompagnie() ?>"><?= $tarifFrontiere->codeCompagnie()." : ".$compagnieActionController->getCompagnieById($tarifFrontiere->codeCompagnie())->raisonSociale() ?></option>
                                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                                <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Classe</label>
                                                            <div class="controls">
                                                                <select name="codeClasse" id="codeClasse<?= $tarifFrontiere->id() ?>" onchange="getSousClasse(<?= $tarifFrontiere->id() ?>)">
                                                                    <option value="<?= $tarifFrontiere->codeClasse() ?>"><?= $tarifFrontiere->codeClasse() ?></option>
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
                                                                <select name="codeSousClasse" id="codeSousClasse<?= $tarifFrontiere->id() ?>">
                                                                    <option value="<?= $tarifFrontiere->codeSousClasse() ?>"><?= $tarifFrontiere->codeSousClasse() ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Designation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="designation"  value="<?= $tarifFrontiere->designation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Periode</label>
                                                            <div class="controls">
                                                                <input class="span4" required="required" type="text" name="periode"  value="<?= $tarifFrontiere->periode() ?>" />
                                                                <select class="span4" name="typePeriode">
                                                                    <option value="<?= $tarifFrontiere->typePeriode() ?>"><?= $tarifFrontiere->typePeriode() ?></option>
                                                                    <option disabled="disabled">-----------------</option>
                                                                    <option value="Jours">Jours</option>
                                                                    <option value="Mois">Mois</option>
                                                                    <option value="Ans">Ans</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeRC</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeRC"  value="<?= $tarifFrontiere->primeRC() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taxe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxe"  value="<?= $tarifFrontiere->taxe() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PrimeDR</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeDR"  value="<?= $tarifFrontiere->primeDR() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TaxeDR</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxeDR"  value="<?= $tarifFrontiere->taxeDR() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Timbre</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="timbre"  value="<?= $tarifFrontiere->timbre() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxMajoration</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxMajoration"  value="<?= $tarifFrontiere->tauxMajoration() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TaxeRemorque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxeRemorque"  value="<?= $tarifFrontiere->taxeRemorque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxCommission</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxCommission"  value="<?= $tarifFrontiere->tauxCommission() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TauxTPS</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxTPS"  value="<?= $tarifFrontiere->tauxTPS() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idTarifFrontiere" value="<?= $tarifFrontiere->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="tarifFrontiere" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteTarifFrontiere box begin -->
                                            <div id="deleteTarifFrontiere<?= $tarifFrontiere->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer TarifFrontiere</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer TarifFrontiere : <?= $tarifFrontiere->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idTarifFrontiere" value="<?= $tarifFrontiere->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="tarifFrontiere" />    
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
                                    <?php /*if($tarifFrontieresNumber != 0){ echo $pagination; }*/ ?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
        <script>
        jQuery(document).ready( function(){ 
            App.setPage("table_managed"); App.init();
            $(".delete").click(function(){
                alert('Hello');
                var del_id = $(this).attr('id');
                var rowElement = $(this).parent().parent();
                $.ajax({
                    type:'POST',
                    url:'../ajax/delete-element.php',
                    data: {delete_id : del_id},
                    success:function(data) {
                        if(data == "YES") {
                            rowElement.fadeOut(500).remove();
                        }   
                    }
                });
            });
        } );
        </script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>

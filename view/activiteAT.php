<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $activiteATActionController = new ActiviteATActionController('activiteAT');
    $compagnieActionController = new CompagnieActionController('compagnie');
    //objects and vars
    $compagnies = $compagnieActionController->getCompagnies();
    $activiteATNumber = $activiteATActionController->getActiviteATsNumber(); 
    $p = 1;
    if ( $activiteATNumber != 0 ) {
        $activiteATPerPage = 20;
        $pageNumber = ceil($activiteATNumber/$activiteATPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $activiteATPerPage;
        $pagination = paginate('activiteAT.php', '?p=', $pageNumber, $p);
        $activiteATs = $activiteATActionController->getActiviteATsByLimits($begin, $activiteATPerPage);
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
                                <li><i class="icon-list-ol"></i><a>Activités AT</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addActiviteAT box begin -->
                            <div id="addActiviteAT" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter ActiviteAT</h3>
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
                                                <input required="required" type="text" name="codeClasse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Code Activite</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeActivite" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Description</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="description" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taux</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taux" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="activiteAT" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addActiviteAT box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Activites AT</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addActiviteAT" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;ActiviteAT
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10 hidden-phone">Compagnie</th>
                                                <th class="t10 hidden-phone">Classe</th>
                                                <th class="t10"><span class="hidden-phone">Code </span>Activite</th>
                                                <th class="t55">Description</th>
                                                <th class="t5">%Taux</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if ( $activiteATNumber != 0 ) {
                                            foreach ( $activiteATs as $activiteAT ) { 
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteActiviteAT<?= $activiteAT->id() ?>" data-toggle="modal" data-id="<?= $activiteAT->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateActiviteAT<?= $activiteAT->id() ?>" data-toggle="modal" data-id="<?= $activiteAT->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $activiteAT->codeCompagnie() ?></td>
                                                <td class="hidden-phone"><?= $activiteAT->codeClasse() ?></td>
                                                <td><?= $activiteAT->codeActivite() ?></td>
                                                <td><?= $activiteAT->description() ?></td>
                                                <td><?= $activiteAT->taux() ?></td>
                                            </tr> 
                                            <!-- updateActiviteAT box begin -->
                                            <div id="updateActiviteAT<?= $activiteAT->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info ActiviteAT</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Compagnie</label>
                                                            <div class="controls">
                                                                <select name="codeCompagnie">
                                                                    <option value="<?= $activiteAT->codeCompagnie() ?>"><?= $activiteAT->codeCompagnie()." : ".$compagnieActionController->getCompagnieById($activiteAT->codeCompagnie())->raisonSociale() ?></option>
                                                                    <option disabled="disabled">----------------------------------------------</option>
                                                                    <?php foreach ( $compagnies as $compagnie ) { ?>
                                                                    <option value="<?= $compagnie->id() ?>"><?= $compagnie->id()." : ".$compagnie->raisonSociale() ?></option>    
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Classe</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeClasse"  value="<?= $activiteAT->codeClasse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Code Activite</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeActivite"  value="<?= $activiteAT->codeActivite() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Description</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="description"  value="<?= $activiteAT->description() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taux</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taux"  value="<?= $activiteAT->taux() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idActiviteAT" value="<?= $activiteAT->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="activiteAT" />    
                                                                <input type="hidden" name="pageNumber" value="<?= $p ?>" />     
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteActiviteAT box begin -->
                                            <div id="deleteActiviteAT<?= $activiteAT->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer ActiviteAT</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer ActiviteAT : <?= $activiteAT->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idActiviteAT" value="<?= $activiteAT->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="activiteAT" />
                                                                <input type="hidden" name="pageNumber" value="<?= $p ?>" />         
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
                                            }//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php if ( $activiteATNumber != 0 ) { echo $pagination; } ?><br><br>
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

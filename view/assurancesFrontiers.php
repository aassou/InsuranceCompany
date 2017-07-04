<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $assurancesFrontiersActionController        = new AppController('assurancesFrontiers');
    $tarifsAssurancesFrontieresActionController = new AppController('tarifsAssurancesFrontieres'); 
    //get objects
    $assurancesFrontierss = $assurancesFrontiersActionController->getAll();
    /*$assurancesFrontierssNumber = $assurancesFrontiersActionController->getAllNumber(); 
    $p = 1;
    if ( $assurancesFrontierssNumber != 0 ) {
        $assurancesFrontiersPerPage = 20;
        $pageNumber = ceil($assurancesFrontierssNumber/$assurancesFrontiersPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $assurancesFrontiersPerPage;
        $pagination = paginate('assurancesFrontiers.php', '?p=', $pageNumber, $p);
        $assurancesFrontierss = $assurancesFrontiersActionController->getAllByLimits($begin, $assurancesFrontiersPerPage);
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
                                <li><i class="icon-briefcase"></i><a href="production.php">Production</a><i class="icon-angle-right"></i></li>
                                <li><i class="icon-plane"></i><a><strong>Assurances Frontières</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Assurances Frontières</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="assurances-frontiers-add.php">
                                                <i class="icon-plus-sign"></i>&nbsp;Assurances Frontières
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t15 hidden-phone">Actions</th>
                                                <th class="t15">Propriétaire</th>
                                                <th class="t10">Police</th>
                                                <th class="t10">Attestation</th>
                                                <th class="t15">Usage</th>
                                                <th class="t10">D.Effet</th>
                                                <th class="t10">D.Expiration</th>
                                                <th class="t10">Immatriculation</th>
                                                <th class="t5">NPlaces</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $assurancesFrontierssNumber != 0 ) { 
                                            foreach ( $assurancesFrontierss as $assurancesFrontiers ) {
                                                $tarifsAssurancesFrontieres = $tarifsAssurancesFrontieresActionController->getOneById($assurancesFrontiers->idUsage());
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteAssurancesFrontiers<?= $assurancesFrontiers->id() ?>" data-toggle="modal" data-id="<?= $assurancesFrontiers->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="assurances-frontiers-update.php?id=<?= $assurancesFrontiers->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="../print/AssurancesFrontiersPrint.php?id=<?= $assurancesFrontiers->id() ?>" class="btn mini blue" target="_blank"><i class="icon-print"></i></a>
                                                </td>
                                                <td><?= $assurancesFrontiers->proprietaire() ?></td>
                                                <td><?= $assurancesFrontiers->police() ?></td>
                                                <td><?= $assurancesFrontiers->attestation() ?></td>
                                                <td><?= $tarifsAssurancesFrontieres->typeUsage() ?></td>
                                                <td><?= date('d/m/Y', strtotime($assurancesFrontiers->dateEffet())) ?></td>
                                                <td><?= date('d/m/Y', strtotime($assurancesFrontiers->dateExpiration())) ?></td>
                                                <td><?= $assurancesFrontiers->immatriculation() ?></td>
                                                <td><?= $assurancesFrontiers->nombrePlaces() ?></td>
                                            </tr>
                                            <!-- deleteAssurancesFrontiers box begin -->
                                            <div id="deleteAssurancesFrontiers<?= $assurancesFrontiers->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Assurances Frontières</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Assurances Frontières : <?= $assurancesFrontiers->police() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $assurancesFrontiers->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="assurancesFrontiers" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteAssurancesFrontiers box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($assurancesFrontierssNumber != 0){ echo $pagination; }*/ ?><br>
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

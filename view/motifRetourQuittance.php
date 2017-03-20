<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $motifRetourQuittanceActionController = new MotifRetourQuittanceActionController('motifRetourQuittance');
    //objects and vars
    $motifRetourQuittances = $motifRetourQuittanceActionController->getMotifRetourQuittances(); 
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
                                <li><i class="icon-signin"></i><a>Motif Retour Quittance</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addMotifRetourQuittance box begin -->
                            <div id="addMotifRetourQuittance" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter MotifRetourQuittance</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">Code</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="code" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Libelle</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="libelle" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="motifRetourQuittance" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addMotifRetourQuittance box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Motif Retour Quittance</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addMotifRetourQuittance" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;MotifRetourQuittance
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone ">Actions</th>
                                                <th class="t10">Code</th>
                                                <th class="t80">Libelle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $motifRetourQuittances as $motifRetourQuittance ) { ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteMotifRetourQuittance<?= $motifRetourQuittance->id() ?>" data-toggle="modal" data-id="<?= $motifRetourQuittance->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateMotifRetourQuittance<?= $motifRetourQuittance->id() ?>" data-toggle="modal" data-id="<?= $motifRetourQuittance->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $motifRetourQuittance->code() ?></td>
                                                <td><?= $motifRetourQuittance->libelle() ?></td>
                                            </tr> 
                                            <!-- updateMotifRetourQuittance box begin -->
                                            <div id="updateMotifRetourQuittance<?= $motifRetourQuittance->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info MotifRetourQuittance</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Code</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="code"  value="<?= $motifRetourQuittance->code() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Libelle</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="libelle"  value="<?= $motifRetourQuittance->libelle() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idMotifRetourQuittance" value="<?= $motifRetourQuittance->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="motifRetourQuittance" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteMotifRetourQuittance box begin -->
                                            <div id="deleteMotifRetourQuittance<?= $motifRetourQuittance->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer MotifRetourQuittance</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer MotifRetourQuittance : <?= $motifRetourQuittance->code() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idMotifRetourQuittance" value="<?= $motifRetourQuittance->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="motifRetourQuittance" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteClasse box end --> 
                                            <?php } ?>
                                        </tbody>
                                    </table>
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

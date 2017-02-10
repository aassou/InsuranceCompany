<?php
require('../app/classLoad.php');
spl_autoload_register("classLoad"); 
require('../app/PDOFactory.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    $classeManager = new ClasseManager(PDOFactory::getMysqlConnection());
    $sousClasseManager = new SousClasseManager(PDOFactory::getMysqlConnection());
    $classes = $classeManager->getClasses();
    $sousClasses = $sousClasseManager->getSousClasses();
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
                                <li><i class="icon-copy"></i><a>Sous Classes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addSousClasse box begin -->
                            <div id="addSousClasse" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Nouvelle Sous Classe</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Code Classe</label>
                                            <div class="controls">
                                                <select name="codeClasse">
                                                    <?php foreach ( $classes as $classe ) { ?>
                                                        <option value="<?= $classe->code() ?>"><?= $classe->code() ?></option>    
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Code Sous Classe</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="code" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Designation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="designation" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="sousClasse" />    
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- addClasse box end -->
                            <div class="portlet box light-grey" id="history">
                                <div class="portlet-title">
                                    <h4>Liste des Sous Classes</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addSousClasse" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Sous Classe
                                            </a>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th class="hidden-phone" style="width: 10%">Actions</th>
                                                    <th style="width: 20%">Code Classe</th>
                                                    <th style="width: 20%">Code Sous Classe</th>
                                                    <th style="width: 50%">Designation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $sousClasses as $sousClasse ) { ?>
                                                <tr>
                                                    <td class="hidden-phone">
                                                        <a href="#deleteSousClasse<?= $sousClasse->id() ?>" data-toggle="modal" data-id="<?= $sousClasse->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                        <a href="#updateSousClasse<?= $sousClasse->id() ?>" data-toggle="modal" data-id="<?= $sousClasse->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    </td>
                                                    <td><?= $sousClasse->codeClasse() ?></td>
                                                    <td><?= $sousClasse->code() ?></td>
                                                    <td><?= $sousClasse->designation() ?></td>
                                                </tr> 
                                                <!-- updateSousClasse box begin -->
                                                <div id="updateSousClasse<?= $sousClasse->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h3>Modifier Info Sous Classe</h3>
                                                    </div>
                                                    <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="control-group">
                                                                <label class="control-label">Code Classe</label>
                                                                <div class="controls">
                                                                    <select name="codeClasse">
                                                                        <option value="<?= $sousClasse->codeClasse() ?>"><?= $sousClasse->codeClasse() ?></option>
                                                                        <option disabled="disabled">--------------------------------</option>
                                                                        <?php foreach ( $classes as $classe ) { ?>
                                                                            <option value="<?= $classe->code() ?>"><?= $classe->code() ?></option>    
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Code Sous Classe</label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" name="code"  value="<?= $sousClasse->code() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Designation</label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" name="designation"  value="<?= $sousClasse->designation() ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="hidden" name="idSousClasse" value="<?= $sousClasse->id() ?>" />
                                                                    <input type="hidden" name="action" value="update" />
                                                                    <input type="hidden" name="source" value="sousClasse" />    
                                                                    <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                    <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- updateSousClasse box end --> 
                                                <!-- deleteSousClasse box begin -->
                                                <div id="deleteSousClasse<?= $sousClasse->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h3>Supprimer Sous Classe</h3>
                                                    </div>
                                                    <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                        <div class="modal-body">
                                                            <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer cette Sous Classe : <?= $sousClasse->code() ?> ? Cette action est irréversible!</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="hidden" name="idSousClasse" value="<?= $sousClasse->id() ?>" />
                                                                    <input type="hidden" name="action" value="delete" />
                                                                    <input type="hidden" name="source" value="sousClasse" />    
                                                                    <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                    <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- deleteSousClasse box end --> 
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
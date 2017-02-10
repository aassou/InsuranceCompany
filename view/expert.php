<?php
require('../app/classLoad.php');
spl_autoload_register("classLoad"); 
require('../app/PDOFactory.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    $expertManager = new ExpertManager(PDOFactory::getMysqlConnection());
    $experts = $expertManager->getExperts(); 
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
                                <li><i class="icon-eye-open"></i><a>Experts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addExpert box begin -->
                            <div id="addExpert" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Expert</h3>
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
                                            <label class="control-label">Nom</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nom" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="adresse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Ville</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="ville" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tel1</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tel1" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tel2</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tel2" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Fax</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="fax" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="expert" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addExpert box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Experts</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addExpert" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Expert
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="hidden-phone" style="width: 10%">Actions</th>
                                                <th style="width: 10%">Code</th>
                                                <th style="width: 10%">Nom</th>
                                                <th style="width: 10%">Adresse</th>
                                                <th style="width: 10%">Ville</th>
                                                <th style="width: 10%">Tel1</th>
                                                <th style="width: 10%">Tel2</th>
                                                <th style="width: 10%">Fax</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $experts as $expert ) { ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteExpert<?= $expert->id() ?>" data-toggle="modal" data-id="<?= $expert->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateExpert<?= $expert->id() ?>" data-toggle="modal" data-id="<?= $expert->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $expert->code() ?></td>
                                                <td><?= $expert->nom() ?></td>
                                                <td><?= $expert->adresse() ?></td>
                                                <td><?= $expert->ville() ?></td>
                                                <td><?= $expert->tel1() ?></td>
                                                <td><?= $expert->tel2() ?></td>
                                                <td><?= $expert->fax() ?></td>
                                            </tr> 
                                            <!-- updateExpert box begin -->
                                            <div id="updateExpert<?= $expert->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Expert</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Code</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="code"  value="<?= $expert->code() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Nom</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="nom"  value="<?= $expert->nom() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="adresse"  value="<?= $expert->adresse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Ville</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="ville"  value="<?= $expert->ville() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tel1</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="tel1"  value="<?= $expert->tel1() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tel2</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="tel2"  value="<?= $expert->tel2() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Fax</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="fax"  value="<?= $expert->fax() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idExpert" value="<?= $expert->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="expert" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteExpert box begin -->
                                            <div id="deleteExpert<?= $expert->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Expert</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Expert : <?= $expert->code() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idExpert" value="<?= $expert->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="expert" />    
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

<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    $commercialManager = new CommercialManager(PDOFactory::getMysqlConnection());
    $commercials = $commercialManager->getCommercials(); 
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
                                <li><i class="icon-group"></i><a>Commerciaux</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addCommercial box begin -->
                            <div id="addCommercial" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Commercial</h3>
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
                                            <label class="control-label">RaisonSocial</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="raisonSocial" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">NomContact</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nomContact" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="Adresse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Rue</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="Rue" />
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
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="email" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="commercial" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addCommercial box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Commerciaux</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addCommercial" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Commercial
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10 hidden-phone">Code</th>
                                                <th class="t20">Raison Sociale</th>
                                                <th class="t10">Contact</th>
                                                <th class="t10 hidden-phone">Adresse</th>
                                                <th class="t10 hidden-phone">Rue</th>
                                                <th class="t10">Tel1</th>
                                                <th class="t10">Tel2</th>
                                                <th class="t10 hidden-phone">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $commercials as $commercial ) { ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteCommercial<?= $commercial->id() ?>" data-toggle="modal" data-id="<?= $commercial->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateCommercial<?= $commercial->id() ?>" data-toggle="modal" data-id="<?= $commercial->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td class="hidden-phone"><?= $commercial->code() ?></td>
                                                <td><?= $commercial->raisonSocial() ?></td>
                                                <td><?= $commercial->nomContact() ?></td>
                                                <td class="hidden-phone"><?= $commercial->Adresse() ?></td>
                                                <td class="hidden-phone"><?= $commercial->Rue() ?></td>
                                                <td><?= $commercial->tel1() ?></td>
                                                <td><?= $commercial->tel2() ?></td>
                                                <td class="hidden-phone"><?= $commercial->email() ?></td>
                                            </tr> 
                                            <!-- updateCommercial box begin -->
                                            <div id="updateCommercial<?= $commercial->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Commercial</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Code</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="code"  value="<?= $commercial->code() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">RaisonSocial</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="raisonSocial"  value="<?= $commercial->raisonSocial() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NomContact</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="nomContact"  value="<?= $commercial->nomContact() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="Adresse"  value="<?= $commercial->Adresse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Rue</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="Rue"  value="<?= $commercial->Rue() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tel1</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="tel1"  value="<?= $commercial->tel1() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tel2</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="tel2"  value="<?= $commercial->tel2() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Email</label>
                                                            <div class="controls">
                                                                <input class="m-wrap" type="text" name="email"  value="<?= $commercial->email() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idCommercial" value="<?= $commercial->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="commercial" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClasse box end --> 
                                            <!-- deleteCommercial box begin -->
                                            <div id="deleteCommercial<?= $commercial->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Commercial</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Commercial : <?= $commercial->code() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idCommercial" value="<?= $commercial->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="commercial" />    
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

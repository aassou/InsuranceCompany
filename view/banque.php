<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    $banqueManager = new BanqueManager(PDOFactory::getMysqlConnection());
    $banques = $banqueManager->getBanques();
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
                                <li><i class="icon-credit-card"></i><a>Banques</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addBanque box begin -->
                            <div id="addBanque" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Nouvelle Banque</h3>
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
                                            <label class="control-label">Raison Sociale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="raisonSociale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nom du contact</label>
                                            <div class="controls">
                                                <input type="text" name="nomContact" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tél Portable</label>
                                            <div class="controls">
                                                <input type="text" name="tel1" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input type="text" name="adresse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Rue</label>
                                            <div class="controls">
                                                <input type="text" name="rue" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Téléphone</label>
                                            <div class="controls">
                                                <input type="text" name="tel2" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Fax</label>
                                            <div class="controls">
                                                <input type="text" name="fax" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                                <input type="text" name="email" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="banque" />    
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- addBanque box end -->
                            <div class="portlet box light-grey" id="history">
                                <div class="portlet-title">
                                    <h4>Liste des banques</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addBanque" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Banque
                                            </a>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th class="t10 hidden-phone">Actions</th>
                                                    <th class="t10">Code</th>
                                                    <th class="t40">Raison Sociale</th>
                                                    <th class="t30">Contact</th>
                                                    <th class="t20">Tél</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $banques as $banque ) { ?>
                                                <tr>
                                                    <td class="hidden-phone">
                                                        <a href="#deleteBanque<?= $banque->id() ?>" data-toggle="modal" data-id="<?= $banque->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                        <a href="#updateBanque<?= $banque->id() ?>" data-toggle="modal" data-id="<?= $banque->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    </td>
                                                    <td><?= $banque->code() ?></td>
                                                    <td><?= $banque->raisonSociale() ?></td>
                                                    <td><?= $banque->nomContact() ?></td>
                                                    <td><?= $banque->tel1() ?></td>
                                                </tr> 
                                                <!-- updateBanque box begin -->
                                                <div id="updateBanque<?= $banque->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h3>Modifier Info Banque</h3>
                                                    </div>
                                                    <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="control-group">
                                                                <label class="control-label">Code</label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" name="code" value="<?= $banque->code() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Raison Sociale</label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" name="raisonSociale" value="<?= $banque->raisonSociale() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Nom du contact</label>
                                                                <div class="controls">
                                                                    <input type="text" name="nomContact" value="<?= $banque->nomContact() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Tél Portable</label>
                                                                <div class="controls">
                                                                    <input type="text" name="tel1" value="<?= $banque->tel1() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Adresse</label>
                                                                <div class="controls">
                                                                    <input type="text" name="adresse" value="<?= $banque->adresse() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Rue</label>
                                                                <div class="controls">
                                                                    <input type="text" name="rue" value="<?= $banque->rue() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Téléphone</label>
                                                                <div class="controls">
                                                                    <input type="text" name="tel2" value="<?= $banque->tel2() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Fax</label>
                                                                <div class="controls">
                                                                    <input type="text" name="fax" value="<?= $banque->fax() ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Email</label>
                                                                <div class="controls">
                                                                    <input type="text" name="email" value="<?= $banque->email() ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="hidden" name="idBanque" value="<?= $banque->id() ?>" />
                                                                    <input type="hidden" name="action" value="update" />
                                                                    <input type="hidden" name="source" value="banque" />    
                                                                    <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                    <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- updateBanque box end --> 
                                                <!-- deleteBanque box begin -->
                                                <div id="deleteBanque<?= $banque->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h3>Supprimer Banque</h3>
                                                    </div>
                                                    <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                        <div class="modal-body">
                                                            <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer cette Banque : <?= $banque->raisonSociale() ?> ? Cette action est irréversible!</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="hidden" name="idBanque" value="<?= $banque->id() ?>" />
                                                                    <input type="hidden" name="action" value="delete" />
                                                                    <input type="hidden" name="source" value="banque" />    
                                                                    <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                    <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- deleteBanque box end --> 
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

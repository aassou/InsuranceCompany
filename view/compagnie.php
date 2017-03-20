<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $compagnieController = new CompagnieActionController('compagnie');
    //objects and vars
    $compagnies = $compagnieController->getCompagnies();
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
                                <li><i class="icon-sitemap"></i><a>Compagnies</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addCompagnie box begin -->
                            <div id="addCompagnie" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Nouvelle Compagnie</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="row cas-libre-padding">
                                            <div class="col-md-4">
                                                <input type="text" value="" name="raisonSociale" class="m-wrap" placeholder="Raison Sociale" />
                                                <input type="text" value="" name="raisonSocialeAbrege" class="m-wrap" placeholder="Raison Sociale Abrégée" />
                                                <input type="text" value="" name="codeMF" class="m-wrap" placeholder="Code MF" />
                                                <input type="text" value="" name="codeIntermediaire" class="m-wrap" placeholder="Code Intermediaire" />
                                             </div>
                                        </div>
                                        <div class="row cas-libre-padding">
                                            <div class="col-md-4">
                                                <input type="text" value="" name="correspondantAuto" class="m-wrap" placeholder="Correspondant Auto" />
                                                <input type="text" value="" name="telCorrespondantAuto" class="m-wrap" placeholder="Tél Correspondant Auto" />
                                                <input type="text" value="" name="correspondantSinistre" class="m-wrap" placeholder="Correspondant Sinistre" />
                                                <input type="text" value="" name="telCorrespondantSinistre" class="m-wrap" placeholder="Tél Correspondant Sinistre" />
                                             </div>
                                        </div>
                                        <div class="row cas-libre-padding">
                                            <div class="col-md-4">
                                                <input type="text" value="" name="correspondantRecouvrement" class="m-wrap" placeholder="Correspondant Recouvrement" />
                                                <input type="text" value="" name="telCorrespondantRecouvrement" class="m-wrap" placeholder="Tél Correspondant Recouvrement" />
                                                <input type="text" value="" name="adresse" class="m-wrap" placeholder="Adresse" />
                                                <input type="text" value="" name="rue" class="m-wrap" placeholder="Rue" />
                                             </div>
                                        </div>
                                        <div class="row cas-libre-padding">
                                            <div class="col-md-3">
                                                <input type="text" value="" name="tel" class="m-wrap" placeholder="Téléphone" />
                                                <input type="text" value="" name="fax" class="m-wrap" placeholder="Fax" />
                                                <input type="text" value="" name="email" class="m-wrap" placeholder="Email" />
                                             </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="compagnie" />    
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- addCompagnie box end -->
                            <div class="portlet box light-grey" id="history">
                                <div class="portlet-title">
                                    <h4>Liste des compagnies</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addCompagnie" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Compagnie
                                            </a>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th class="t10 hidden-phone">Actions</th>
                                                    <th class="t25" >Raison Sociale</th>
                                                    <th class="t15 hidden-phone">Code Intermedi</th>
                                                    <th class="t15 hidden-phone">Auto</th>
                                                    <th class="t15 hidden-phone">Sinistre</th>
                                                    <th class="t15 hidden-phone">Recouvrement</th>
                                                    <th class="t5 hidden-phone">Tél</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $compagnies as $compagnie ) { ?>
                                                <tr>
                                                    <td class="hidden-phone">
                                                        <a href="#deleteCompagnie<?= $compagnie->id() ?>" data-toggle="modal" data-id="<?= $compagnie->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                        <a href="#updateCompagnie<?= $compagnie->id() ?>" data-toggle="modal" data-id="<?= $compagnie->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    </td>
                                                    <td><?= $compagnie->raisonSociale() ?></td>
                                                    <td class="hidden-phone"><?= $compagnie->codeIntermediaire() ?></td>
                                                    <td class="hidden-phone"><?= $compagnie->correspondantAuto() ?></td>
                                                    <td class="hidden-phone"><?= $compagnie->correspondantSinistre() ?></td>
                                                    <td class="hidden-phone"><?= $compagnie->correspondantRecouvrement() ?></td>
                                                    <td class="hidden-phone"><?= $compagnie->tel() ?></td>
                                                </tr> 
                                                <!-- updateCompagnie box begin -->
                                                <div id="updateCompagnie<?= $compagnie->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h3>Modifier Info Compagnie</h3>
                                                    </div>
                                                    <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="row cas-libre-padding">
                                                                <div class="col-md-4">
                                                                    <input type="text" value="<?= $compagnie->raisonSociale() ?>" name="raisonSociale" class="m-wrap" placeholder="Raison Sociale" />
                                                                    <input type="text" value="<?= $compagnie->raisonSocialeAbrege() ?>" name="raisonSocialeAbrege" class="m-wrap" placeholder="Raison Sociale Abrégée" />
                                                                    <input type="text" value="<?= $compagnie->codeMF() ?>" name="codeMF" class="m-wrap" placeholder="Code MF" />
                                                                    <input type="text" value="<?= $compagnie->codeIntermediaire() ?>" name="codeIntermediaire" class="m-wrap" placeholder="Code Intermediaire" />
                                                                 </div>
                                                            </div>
                                                            <div class="row cas-libre-padding">
                                                                <div class="col-md-4">
                                                                    <input type="text" value="<?= $compagnie->correspondantAuto() ?>" name="correspondantAuto" class="m-wrap" placeholder="Correspondant Auto" />
                                                                    <input type="text" value="<?= $compagnie->telCorrespondantAuto() ?>" name="telCorrespondantAuto" class="m-wrap" placeholder="Tél Correspondant Auto" />
                                                                    <input type="text" value="<?= $compagnie->correspondantSinistre() ?>" name="correspondantSinistre" class="m-wrap" placeholder="Correspondant Sinistre" />
                                                                    <input type="text" value="<?= $compagnie->telCorrespondantSinistre() ?>" name="telCorrespondantSinistre" class="m-wrap" placeholder="Tél Correspondant Sinistre" />
                                                                 </div>
                                                            </div>
                                                            <div class="row cas-libre-padding">
                                                                <div class="col-md-4">
                                                                    <input type="text" value="<?= $compagnie->correspondantRecouvrement() ?>" name="correspondantRecouvrement" class="m-wrap" placeholder="Correspondant Recouvrement" />
                                                                    <input type="text" value="<?= $compagnie->telCorrespondantRecouvrement() ?>" name="telCorrespondantRecouvrement" class="m-wrap" placeholder="Tél Correspondant Recouvrement" />
                                                                    <input type="text" value="<?= $compagnie->adresse() ?>" name="adresse" class="m-wrap" placeholder="Adresse" />
                                                                    <input type="text" value="<?= $compagnie->rue() ?>" name="rue" class="m-wrap" placeholder="Rue" />
                                                                 </div>
                                                            </div>
                                                            <div class="row cas-libre-padding">
                                                                <div class="col-md-3">
                                                                    <input type="text" value="<?= $compagnie->tel() ?>" name="tel" class="m-wrap" placeholder="Téléphone" />
                                                                    <input type="text" value="<?= $compagnie->fax() ?>" name="fax" class="m-wrap" placeholder="Fax" />
                                                                    <input type="text" value="<?= $compagnie->email() ?>" name="email" class="m-wrap" placeholder="Email" />
                                                                 </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="hidden" name="idCompagnie" value="<?= $compagnie->id() ?>" />
                                                                    <input type="hidden" name="action" value="update" />
                                                                    <input type="hidden" name="source" value="compagnie" />    
                                                                    <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                    <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- updateCompagnie box end --> 
                                                <!-- updateCompagnie box begin -->
                                                <div id="deleteCompagnie<?= $compagnie->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h3>Supprimer Compagnie</h3>
                                                    </div>
                                                    <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                        <div class="modal-body">
                                                            <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer cette compagnie : <?= $compagnie->raisonSociale() ?> ? Cette action est irréversible!</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="hidden" name="idCompagnie" value="<?= $compagnie->id() ?>" />
                                                                    <input type="hidden" name="action" value="delete" />
                                                                    <input type="hidden" name="source" value="compagnie" />    
                                                                    <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                    <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- deleteCompagnie box end --> 
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

<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    $contratActionController   = new AppController('contratAuto');
    $clientActionController    = new AppController('client');
    $usageActionController     = new AppController('usage');
    $compagnieActionController = new AppController('compagnie');
    //get objects
    $contrats     = $contratActionController->getAll();
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
                                <li><i class="icon-truck"></i><a><strong>Automobile</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Attestations</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="automobile-add-part-1.php">
                                                <i class="icon-plus-sign"></i>&nbsp;Assurance Autombile
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t15">Actions</th>
                                                <th class="t20">Compagnie</th>
                                                <th class="t20">Client</th>
                                                <th class="t10">Attestation</th>
                                                <th class="t10">Police</th>
                                                <th class="t15">Date Echéance</th>
                                                <th class="t10">Prime Totale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $contrats as $contrat ) { ?>
                                            <tr>
                                                <td>
                                                    <a href="automobile-update.php?idContrat=<?= $contrat->id() ?>" class="btn mini" title="Voire"><i class="icon-eye-open"></i></a>
                                                    <a class="btn mini green" title="Modifier"><i class="icon-refresh"></i></a>
                                                    <a href="#deleteContratAuto<?= $contrat->id() ?>" data-toggle="modal" data_id="<?= $contrat->id() ?>" class="btn mini red" title="Supprimer"><i class="icon-remove"></i></a>
                                                </td>
                                                <td><?= $compagnieActionController->getOneById($contrat->idCompagnie())->raisonSociale() ?></td>
                                                <td><?= $clientActionController->getOneByCode($contrat->codeClient())->nom() ?></td>
                                                <td><?= $contrat->attestation() ?></td>
                                                <td><?= $contrat->police() ?></td>
                                                <td><?= date('d/m/Y', strtotime($contrat->dateEcheance())) ?></td>
                                                <td><?= number_format($contrat->primeTotale(), 2, ',', ' ') ?></td>
                                            </tr>
                                            <!-- deleteContratAuto box begin -->
                                            <div id="deleteContratAuto<?= $contrat->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Contrat Assurance Auto</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer ce contrat :  ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="contratAuto" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteAttestation box end --> 
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

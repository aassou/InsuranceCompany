<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $attestationActionController = new AppController('attestation');
    $usageActionController       = new AppController('usage');
    $compagnieActionController   = new AppController('compagnie');
    //get objects
    $attestations = $attestationActionController->getAll(); 
    $usages       = $usageActionController->getAll();
    $compagnies   = $compagnieActionController->getAll();
    /*$attestationsNumber = $attestationActionController->getAllNumber(); 
    $p = 1;
    if ( $attestationsNumber != 0 ) {
        $attestationPerPage = 20;
        $pageNumber = ceil($attestationsNumber/$attestationPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $attestationPerPage;
        $pagination = paginate('attestation.php', '?p=', $pageNumber, $p);
        $attestations = $attestationActionController->getAllByLimits($begin, $attestationPerPage);
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
                                <li><i class="icon-barcode"></i><a>Attestations</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addAttestation box begin -->
                            <div id="addAttestation" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Stock Attestations</h3>
                                </div>
                                <form id="addAttestationForm" class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Compagnie</label>
                                            <div class="controls">
                                                <select name="codeCompagnie" id="codeCompagnie">
                                                    <?php foreach( $compagnies as $compagnie ) { ?>
                                                    <option value="<?= $compagnie->id() ?>"><?= $compagnie->id().": ".$compagnie->raisonSociale() ?></option>
                                                    <?php } ?>
                                                </select>        
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Usage</label>
                                            <div class="controls">
                                                <select name="codeUsage">
                                                    <?php foreach( $usages as $usage ) { ?>
                                                    <option value="<?= $usage->code() ?>"><?= $usage->code() ?></option>
                                                    <?php } ?>
                                                </select>        
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Date Réception</label>
                                            <div class="controls date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                <input name="dateReception" id="dateReception" class="m-wrap m-ctrl-small date-picker" type="text" value="<?= date('Y-m-d') ?>" />
                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                             </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Numéro Debut</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="numeroDebut"  id="numeroDebut" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Numéro Fin</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="numeroFin" id="numeroFin" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nombre Attestation</label>
                                            <div class="controls">
                                                <input required="required" readonly="readonly" type="text" name="nombreAttestation" id="nombreAttestation" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nombre Utilisé</label>
                                            <div class="controls">
                                                <input readonly="readonly" type="text" name="nombreUtilise" value="0" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="attestation" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addAttestation box end -->
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
                                            <a class="btn blue pull-right" href="#addAttestation" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Attestation
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t20">Compagnie</th>
                                                <th class="t10">Usage</th>
                                                <th class="t10">Numéro Debut</th>
                                                <th class="t10">Numéro Fin</th>
                                                <th class="t15">Date Recéption</th>
                                                <th class="t15">Nombre Attestations</th>
                                                <th class="t10">Nombre Utilisé</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $attestationsNumber != 0 ) { 
                                            foreach ( $attestations as $attestation ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteAttestation<?= $attestation->id() ?>" data-toggle="modal" data-id="<?= $attestation->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                                <td><?= $attestation->codeCompagnie() ?></td>
                                                <td><?= $attestation->codeUsage() ?></td>
                                                <td><?= $attestation->numeroDebut() ?></td>
                                                <td><?= $attestation->numeroFin() ?></td>
                                                <td><?= date('d/m/Y', strtotime($attestation->dateReception())) ?></td>
                                                <td><?= $attestation->nombreAttestation() ?></td>
                                                <td><?= $attestation->nombreUtilise() ?></td>
                                            </tr>
                                            <!-- deleteAttestation box begin -->
                                            <div id="deleteAttestation<?= $attestation->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Attestation</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Attestation : <?= $attestation->codeCompagnie() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $attestation->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="attestation" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteAttestation box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($attestationsNumber != 0){ echo $pagination; }*/ ?><br>
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
        jQuery(document).ready( function(){ App.setPage("table_managed"); App.init(); } );
        $('#numeroDebut, #numeroFin').change(function(){
            var numeroDebut = $('#numeroDebut').val();
            var numeroFin = $('#numeroFin').val();
            var nombreAttestation = (numeroFin - numeroDebut) + 1;
            if ( (numeroFin - numeroDebut + 1) >= 1 ) {
                nombreAttestation = (numeroFin - numeroDebut) + 1;    
            }
            else {
                nombreAttestation = "Erreur : Numéro Fin < Numéro Début";
            }
            $('#nombreAttestation').val(nombreAttestation);
        });
        $("#addAttestationForm").validate({
             rules:{
               numeroDebut: {
                   number: true,
                   required: true
               },
               numeroFin: {
                   number: true,
                   required: true
               },
               nombreAttestation: {
                   number: true,
                   required: true
               }
             },
             errorClass: "error-class",
             validClass: "valid-class"
        });
        </script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>

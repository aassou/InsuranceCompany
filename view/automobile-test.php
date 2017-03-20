<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
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
                                <li><i class="icon-truck"></i><a>Automobile</a></li>
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
                                                <th class="t5">Cie</th>
                                                <th class="t10">RéfCab</th>
                                                <th class="t10">Client</th>
                                                <th class="t10">Police</th>
                                                <th class="t10">Avn</th>
                                                <th class="t10">Matri</th>
                                                <th class="t10">Attest</th>
                                                <th class="t10">DEffet</th>
                                                <th class="t10">DExpir</th>
                                                <th class="t10">PrTotal</th>
                                                <th class="t5">Type</th>
                                                <th class="t10">QuitCabi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $attestationsNumber != 0 ) { 
                                            //foreach ( $attestations as $attestation ) {
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <!-- deleteAttestation box begin -->
                                            <div id="deleteAttestation<?php //$attestation->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Attestation</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Attestation :  ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
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
                                            //}//end foreach 
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

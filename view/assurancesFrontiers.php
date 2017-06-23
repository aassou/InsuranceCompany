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
                                                    <a href="#updateAssurancesFrontiers<?= $assurancesFrontiers->id() ?>" data-toggle="modal" data-id="<?= $assurancesFrontiers->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
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
                                            <!-- updateAssurancesFrontiers box begin -->
                                            <div id="updateAssurancesFrontiers<?= $assurancesFrontiers->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Assurances Frontières</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Police</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="police"  value="<?= $assurancesFrontiers->police() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Attestation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="attestation"  value="<?= $assurancesFrontiers->attestation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Usage</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="idUsage"  value="<?= $assurancesFrontiers->idUsage() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateEffet</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="dateEffet"  value="<?= $assurancesFrontiers->dateEffet() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Duree</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="duree"  value="<?= $assurancesFrontiers->duree() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateExpiration</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="dateExpiration"  value="<?= $assurancesFrontiers->dateExpiration() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Proprietaire</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="proprietaire"  value="<?= $assurancesFrontiers->proprietaire() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Passeport</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="passeport"  value="<?= $assurancesFrontiers->passeport() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Cin</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="cin"  value="<?= $assurancesFrontiers->cin() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="adresse"  value="<?= $assurancesFrontiers->adresse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Permis</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="permis"  value="<?= $assurancesFrontiers->permis() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DatePermis</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="datePermis"  value="<?= $assurancesFrontiers->datePermis() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Categorie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="categorie"  value="<?= $assurancesFrontiers->categorie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Immatriculation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="immatriculation"  value="<?= $assurancesFrontiers->immatriculation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Moteur</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="moteur"  value="<?= $assurancesFrontiers->moteur() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Chassis</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="chassis"  value="<?= $assurancesFrontiers->chassis() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Marque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="marque"  value="<?= $assurancesFrontiers->marque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Type</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="type"  value="<?= $assurancesFrontiers->type() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TypeCarrosserie</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="typeCarrosserie"  value="<?= $assurancesFrontiers->typeCarrosserie() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">PoidsTotalCharge</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="poidsTotalCharge"  value="<?= $assurancesFrontiers->poidsTotalCharge() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NombrePlaces</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nombrePlaces"  value="<?= $assurancesFrontiers->nombrePlaces() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Remorque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="remorque"  value="<?= $assurancesFrontiers->remorque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">ImmatriculationRemorque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="immatriculationRemorque"  value="<?= $assurancesFrontiers->immatriculationRemorque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Cylindre</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="cylindre"  value="<?= $assurancesFrontiers->cylindre() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Intermediaire</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="intermediaire"  value="<?= $assurancesFrontiers->intermediaire() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $assurancesFrontiers->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="assurancesFrontiers" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateAssurancesFrontiers box end --> 
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

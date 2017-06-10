<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $chequeActionController = new AppController('cheque');
    //get objects
    $cheques = $chequeActionController->getAll(); 
    /*$chequesNumber = $chequeActionController->getAllNumber(); 
    $p = 1;
    if ( $chequesNumber != 0 ) {
        $chequePerPage = 20;
        $pageNumber = ceil($chequesNumber/$chequePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $chequePerPage;
        $pagination = paginate('cheque.php', '?p=', $pageNumber, $p);
        $cheques = $chequeActionController->getAllByLimits($begin, $chequePerPage);
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
                                <li><i class="icon-envelope-alt"></i><a href="cheque.php"><strong>Chèques</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addCheque box begin -->
                            <div id="addCheque" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Cheque</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Date</label>
                                            <div class="controls date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                <input name="date" id="date" class="m-wrap m-ctrl-small date-picker" type="text" value="<?= date('Y-m-d') ?>" />
                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                             </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Numero</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="numero" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                        <label class="control-label">Désignation</label>
                                        <div class="controls">
                                            <input class="span5" type="text" name="designationSociete" placeholder="Société" />
                                            <input class="span5" type="text" name="designationPersonne" placeholder="Personne" />
                                        </div>
                                    </div>
                                        <div class="control-group">
                                            <label class="control-label">Montant</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="montant" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Compte Bancaire</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="compteBancaire" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Status</label>
                                            <div class="controls">
                                                <select name="status">
                                                    <option value="0">En cours</option>
                                                    <option value="1">Déposé</option>
                                                    <option value="2">Déposé+TVA</option>
                                                    <option value="3">Annulé</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Copie Chèque</label>
                                            <div class="controls">
                                                <input type="file" name="url" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="cheque" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addCheque box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Cheques</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addCheque" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Cheque
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">Date</th>
                                                <th class="t10">Numero</th>
                                                <th class="t10">DesignationSociete</th>
                                                <th class="t10">DesignationPersonne</th>
                                                <th class="t10">Montant</th>
                                                <th class="t10">CompteBancaire</th>
                                                <th class="t10">Status</th>
                                                <th class="t10">Url</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $chequesNumber != 0 ) { 
                                            foreach ( $cheques as $cheque ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteCheque<?= $cheque->id() ?>" data-toggle="modal" data-id="<?= $cheque->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateCheque<?= $cheque->id() ?>" data-toggle="modal" data-id="<?= $cheque->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $cheque->date() ?></td>
                                                <td><?= $cheque->numero() ?></td>
                                                <td><?= $cheque->designationSociete() ?></td>
                                                <td><?= $cheque->designationPersonne() ?></td>
                                                <td><?= $cheque->montant() ?></td>
                                                <td><?= $cheque->compteBancaire() ?></td>
                                                <td><?= $cheque->status() ?></td>
                                                <td><?= $cheque->url() ?></td>
                                            </tr> 
                                            <!-- updateCheque box begin -->
                                            <div id="updateCheque<?= $cheque->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Cheque</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Date</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="date"  value="<?= $cheque->date() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Numero</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="numero"  value="<?= $cheque->numero() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DesignationSociete</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="designationSociete"  value="<?= $cheque->designationSociete() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DesignationPersonne</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="designationPersonne"  value="<?= $cheque->designationPersonne() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Montant</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="montant"  value="<?= $cheque->montant() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CompteBancaire</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="compteBancaire"  value="<?= $cheque->compteBancaire() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Status</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="status"  value="<?= $cheque->status() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Url</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="url"  value="<?= $cheque->url() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $cheque->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="cheque" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateCheque box end --> 
                                            <!-- deleteCheque box begin -->
                                            <div id="deleteCheque<?= $cheque->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Cheque</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Cheque : <?= $cheque->numero().' - '.$cheque->designationSociete() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $cheque->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="cheque" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteCheque box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($chequesNumber != 0){ echo $pagination; }*/ ?><br>
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

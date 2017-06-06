<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $compteBancaireActionController = new AppController('compteBancaire');
    //get objects
    $compteBancaires = $compteBancaireActionController->getAll(); 
    /*$compteBancairesNumber = $compteBancaireActionController->getAllNumber(); 
    $p = 1;
    if ( $compteBancairesNumber != 0 ) {
        $compteBancairePerPage = 20;
        $pageNumber = ceil($compteBancairesNumber/$compteBancairePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $compteBancairePerPage;
        $pagination = paginate('compteBancaire.php', '?p=', $pageNumber, $p);
        $compteBancaires = $compteBancaireActionController->getAllByLimits($begin, $compteBancairePerPage);
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
                                <li><i class="icon-wrench"></i><a href="configuration.php">Paramètrages</a><i class="icon-angle-right"></i></li>
                                <li><i class="icon-money"></i><a>Comptes Bancaires</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addCompteBancaire box begin -->
                            <div id="addCompteBancaire" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter CompteBancaire</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">Numero</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="numero" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Designation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="designation" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Date Création</label>
                                            <div class="controls">
                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                    <input name="dateCreation" id="dateCreation" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="compteBancaire" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addCompteBancaire box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des CompteBancaires</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addCompteBancaire" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;CompteBancaire
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t30">Numero</th>
                                                <th class="t30">Designation</th>
                                                <th class="t30">Date Création</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $compteBancairesNumber != 0 ) { 
                                            foreach ( $compteBancaires as $compteBancaire ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteCompteBancaire<?= $compteBancaire->id() ?>" data-toggle="modal" data-id="<?= $compteBancaire->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateCompteBancaire<?= $compteBancaire->id() ?>" data-toggle="modal" data-id="<?= $compteBancaire->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $compteBancaire->numero() ?></td>
                                                <td><?= $compteBancaire->designation() ?></td>
                                                <td><?= $compteBancaire->dateCreation() ?></td>
                                            </tr> 
                                            <!-- updateCompteBancaire box begin -->
                                            <div id="updateCompteBancaire<?= $compteBancaire->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info CompteBancaire</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Numero</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="numero"  value="<?= $compteBancaire->numero() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Designation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="designation"  value="<?= $compteBancaire->designation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateCreation</label>
                                                            <div class="controls">
                                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                    <input name="dateCreation" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= $compteBancaire->dateCreation() ?>" />
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idCompteBancaire" value="<?= $compteBancaire->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="compteBancaire" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateCompteBancaire box end --> 
                                            <!-- deleteCompteBancaire box begin -->
                                            <div id="deleteCompteBancaire<?= $compteBancaire->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer CompteBancaire</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer CompteBancaire : <?= $compteBancaire->numero() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idCompteBancaire" value="<?= $compteBancaire->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="compteBancaire" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteCompteBancaire box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($compteBancairesNumber != 0){ echo $pagination; }*/ ?><br>
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

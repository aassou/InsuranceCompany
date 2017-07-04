<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $carteVerteActionController = new AppController('carteVerte');
    //get objects
    $carteVertes = $carteVerteActionController->getAll(); 
    /*$carteVertesNumber = $carteVerteActionController->getAllNumber(); 
    $p = 1;
    if ( $carteVertesNumber != 0 ) {
        $carteVertePerPage = 20;
        $pageNumber = ceil($carteVertesNumber/$carteVertePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $carteVertePerPage;
        $pagination = paginate('carteVerte.php', '?p=', $pageNumber, $p);
        $carteVertes = $carteVerteActionController->getAllByLimits($begin, $carteVertePerPage);
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
                                <li><i class="icon-file"></i><a><strong>Cartes Vertes</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addCarteVerte box begin -->
                            <div id="addCarteVerte" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter CarteVerte</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label" for="dateEffet">Date Effet</label>
                                            <div class="controls">
                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                    <input name="dateEffet" id="dateEffet" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="dateExpiration">Date Expiration</label>
                                            <div class="controls">
                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                    <input name="dateExpiration" id="dateExpiration" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Immatriculation</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="immatriculation" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Categorie</label>
                                            <div class="controls">
                                                <select class="m-wrap" name="categorie">
                                                    <option value="A">A: AUTOMOBILE</option>
                                                    <option value="B">B: MOTOCYCLETE</option>
                                                    <option value="C">C: CAMION OU TRACTEUR</option>
                                                    <option value="D">D: CYCLE A MOTEUR AUXILIAIRE</option>
                                                    <option value="E">E: AUTOBUS OU AUTOCAR</option>
                                                    <option value="F">F: REMORQUE</option>
                                                    <option value="G">G: AUTRE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Marque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="marque" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">N° Police</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="numeroPolice" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Souscripteur</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="souscripteur" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="adresse" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="carteVerte" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addCarteVerte box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Cartes Vertes</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addCarteVerte" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;CarteVerte
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">DateEffet</th>
                                                <th class="t10">DateExpiration</th>
                                                <th class="t10">Immatriculation</th>
                                                <th class="t10">Categorie</th>
                                                <th class="t10">Marque</th>
                                                <th class="t10">NumeroPolice</th>
                                                <th class="t10">Souscripteur</th>
                                                <th class="t10">Adresse</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $carteVertesNumber != 0 ) { 
                                            foreach ( $carteVertes as $carteVerte ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteCarteVerte<?= $carteVerte->id() ?>" data-toggle="modal" data-id="<?= $carteVerte->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateCarteVerte<?= $carteVerte->id() ?>" data-toggle="modal" data-id="<?= $carteVerte->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a target="_blank" href="../print/CarteVertePrint.php?id=<?= $carteVerte->id() ?>" class="btn mini blue"><i class="icon-print"></i></a>
                                                </td>
                                                <td><?= date('d/m/Y', strtotime($carteVerte->dateEffet())) ?></td>
                                                <td><?= date('d/m/Y', strtotime($carteVerte->dateExpiration())) ?></td>
                                                <td><?= $carteVerte->immatriculation() ?></td>
                                                <td><?= $carteVerte->categorie() ?></td>
                                                <td><?= $carteVerte->marque() ?></td>
                                                <td><?= $carteVerte->numeroPolice() ?></td>
                                                <td><?= $carteVerte->souscripteur() ?></td>
                                                <td><?= $carteVerte->adresse() ?></td>
                                            </tr> 
                                            <!-- updateCarteVerte box begin -->
                                            <div id="updateCarteVerte<?= $carteVerte->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info CarteVerte</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label" for="dateEffet">Date Effet</label>
                                                            <div class="controls">
                                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                    <input name="dateEffet" id="dateEffet" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= $carteVerte->dateEffet() ?>" />
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="dateExpiration">Date Expiration</label>
                                                            <div class="controls">
                                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                    <input name="dateExpiration" id="dateExpiration" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= $carteVerte->dateExpiration() ?>" />
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Immatriculation</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="immatriculation"  value="<?= $carteVerte->immatriculation() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Categorie</label>
                                                            <div class="controls">
                                                                <select class="m-wrap" name="categorie">
                                                                    <option value="<?= $carteVerte->categorie() ?>"><?= $carteVerte->categorie() ?></option>
                                                                    <option disabled="disabled">-----------</option>
                                                                    <option value="A">A: AUTOMOBILE</option>
                                                                    <option value="B">B: MOTOCYCLETE</option>
                                                                    <option value="C">C: CAMION OU TRACTEUR</option>
                                                                    <option value="D">D: CYCLE A MOTEUR AUXILIAIRE</option>
                                                                    <option value="E">E: AUTOBUS OU AUTOCAR</option>
                                                                    <option value="F">F: REMORQUE</option>
                                                                    <option value="G">G: AUTRE</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Marque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="marque"  value="<?= $carteVerte->marque() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NumeroPolice</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="numeroPolice"  value="<?= $carteVerte->numeroPolice() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Souscripteur</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="souscripteur"  value="<?= $carteVerte->souscripteur() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="adresse"  value="<?= $carteVerte->adresse() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $carteVerte->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="carteVerte" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateCarteVerte box end --> 
                                            <!-- deleteCarteVerte box begin -->
                                            <div id="deleteCarteVerte<?= $carteVerte->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer CarteVerte</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer CarteVerte : <?= $carteVerte->dateEffet() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $carteVerte->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="carteVerte" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteCarteVerte box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($carteVertesNumber != 0){ echo $pagination; }*/ ?><br>
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

<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $tarifsAssurancesFrontieresActionController = new AppController('tarifsAssurancesFrontieres');
    //get objects
    $tarifsAssurancesFrontieress = $tarifsAssurancesFrontieresActionController->getAll(); 
    /*$tarifsAssurancesFrontieressNumber = $tarifsAssurancesFrontieresActionController->getAllNumber(); 
    $p = 1;
    if ( $tarifsAssurancesFrontieressNumber != 0 ) {
        $tarifsAssurancesFrontieresPerPage = 20;
        $pageNumber = ceil($tarifsAssurancesFrontieressNumber/$tarifsAssurancesFrontieresPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $tarifsAssurancesFrontieresPerPage;
        $pagination = paginate('tarifsAssurancesFrontieres.php', '?p=', $pageNumber, $p);
        $tarifsAssurancesFrontieress = $tarifsAssurancesFrontieresActionController->getAllByLimits($begin, $tarifsAssurancesFrontieresPerPage);
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
                                <li><i class="icon-plane"></i><a><strong>Tarifs Assurances Frontières</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addTarifsAssurancesFrontieres box begin -->
                            <div id="addTarifsAssurancesFrontieres" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Tarifs Assurances Frontieres</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">Usage</label>
                                            <div class="controls">
                                                <select required="required" name="typeUsage" >
                                                    <option value="Conduite intérieure">Conduite intérieure</option>
                                                    <option value="Fourgon et utilitaire">Fourgon et utilitaire</option>
                                                    <option value="Camions">Camions</option>
                                                    <option value="Taxi">Taxi</option>
                                                    <option value="Autocars">Autocars</option>
                                                    <option value="2 Roues<=50cm3">2 Roues &le; 50cm3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Période</label>
                                            <div class="controls">
                                                <select required="required" name="periode" >
                                                    <option value="5">5 jours</option>
                                                    <option value="10">10 jours</option>
                                                    <option value="30">1 mois</option>
                                                    <option value="90">3 mois</option>
                                                    <option value="180">6 mois</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeRC</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeRC" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Taxes</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxes" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">PrimeDR</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeDR" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">TaxesDR</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="taxesDR" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Timbre</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="timbre" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prime Totale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="primeTotale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">%PrimeRemorque</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tauxPrimeRemorque" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="tarifsAssurancesFrontieres" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addTarifsAssurancesFrontieres box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Tarifs Assurances Frontières</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addTarifsAssurancesFrontieres" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Tarifs Assurances Frontières
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">Usage</th>
                                                <th class="t10">Periode</th>
                                                <th class="t10">Prime RC</th>
                                                <th class="t10">Taxes</th>
                                                <th class="t10">Prime DR</th>
                                                <th class="t10">Taxes DR</th>
                                                <th class="t10">Timbre</th>
                                                <th class="t10">Prime Totale</th>
                                                <th class="t10">%PrimeRemorque</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $tarifsAssurancesFrontieressNumber != 0 ) { 
                                            foreach ( $tarifsAssurancesFrontieress as $tarifsAssurancesFrontieres ) {
                                                $libellePeriode = "";
                                                $periode = 0;
                                                if ( $tarifsAssurancesFrontieres->periode() <= 10 ) 
                                                {
                                                    $periode = $tarifsAssurancesFrontieres->periode();
                                                    $libellePeriode = "jours";    
                                                }
                                                else 
                                                {
                                                    $periode = $tarifsAssurancesFrontieres->periode()/30;
                                                    $libellePeriode = "mois";
                                                }
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteTarifsAssurancesFrontieres<?= $tarifsAssurancesFrontieres->id() ?>" data-toggle="modal" data-id="<?= $tarifsAssurancesFrontieres->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateTarifsAssurancesFrontieres<?= $tarifsAssurancesFrontieres->id() ?>" data-toggle="modal" data-id="<?= $tarifsAssurancesFrontieres->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $tarifsAssurancesFrontieres->typeUsage() ?></td>
                                                <td><?= $periode.' '.$libellePeriode ?></td>
                                                <td><?= number_format($tarifsAssurancesFrontieres->primeRC(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifsAssurancesFrontieres->taxes(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifsAssurancesFrontieres->primeDR(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifsAssurancesFrontieres->taxesDR(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifsAssurancesFrontieres->timbre(), 2, ',', ' ') ?></td>
                                                <td><?= number_format($tarifsAssurancesFrontieres->primeTotale(), 2, ',', ' ') ?></td>
                                                <td><?= $tarifsAssurancesFrontieres->tauxPrimeRemorque()*100 ?> %</td>
                                            </tr> 
                                            <!-- updateTarifsAssurancesFrontieres box begin -->
                                            <div id="updateTarifsAssurancesFrontieres<?= $tarifsAssurancesFrontieres->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Tarifs Assurances Frontières</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Usage</label>
                                                            <div class="controls">
                                                                <select required="required" name="typeUsage" >
                                                                    <option value="<?= $tarifsAssurancesFrontieres->typeUsage() ?>"><?= $tarifsAssurancesFrontieres->typeUsage() ?></option>
                                                                    <option disabled="disabled">---------------------------</option>
                                                                    <option value="Conduite intérieure">Conduite intérieure</option>
                                                                    <option value="Fourgon et utilitaire">Fourgon et utilitaire</option>
                                                                    <option value="Camions">Camions</option>
                                                                    <option value="Taxi">Taxi</option>
                                                                    <option value="Autocars">Autocars</option>
                                                                    <option value="2 Roues<=50cm3">2 Roues &le; 50cm3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Période</label>
                                                            <div class="controls">
                                                                <select required="required" name="periode" >
                                                                    <option value="<?= $tarifsAssurancesFrontieres->periode() ?>"><?= $tarifsAssurancesFrontieres->periode() ?></option>
                                                                    <option disabled="disabled">---------------------------</option>
                                                                    <option value="5">5 jours</option>
                                                                    <option value="10">10 jours</option>
                                                                    <option value="30">1 mois</option>
                                                                    <option value="90">3 mois</option>
                                                                    <option value="180">6 mois</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prime RC</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeRC"  value="<?= $tarifsAssurancesFrontieres->primeRC() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taxes</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxes"  value="<?= $tarifsAssurancesFrontieres->taxes() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prime DR</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeDR"  value="<?= $tarifsAssurancesFrontieres->primeDR() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Taxes DR</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="taxesDR"  value="<?= $tarifsAssurancesFrontieres->taxesDR() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Timbre</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="timbre"  value="<?= $tarifsAssurancesFrontieres->timbre() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prime Totale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="primeTotale"  value="<?= $tarifsAssurancesFrontieres->primeTotale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">% Prime Remorque</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tauxPrimeRemorque"  value="<?= $tarifsAssurancesFrontieres->tauxPrimeRemorque() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $tarifsAssurancesFrontieres->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="tarifsAssurancesFrontieres" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateTarifsAssurancesFrontieres box end --> 
                                            <!-- deleteTarifsAssurancesFrontieres box begin -->
                                            <div id="deleteTarifsAssurancesFrontieres<?= $tarifsAssurancesFrontieres->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Tarifs Assurances Frontières</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Tarifs Assurances Frontières : <?= $tarifsAssurancesFrontieres->typeUsage() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $tarifsAssurancesFrontieres->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="tarifsAssurancesFrontieres" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteTarifsAssurancesFrontieres box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($tarifsAssurancesFrontieressNumber != 0){ echo $pagination; }*/ ?><br>
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

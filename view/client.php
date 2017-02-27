<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //get Managers
    $clientManager = new ClientManager(PDOFactory::getMysqlConnection());
    //get objects
    $clients = $clientManager->getClients(); 
    $clientsNumber = $clientManager->getClientsNumber(); 
    $p = 1;
    if ( $clientsNumber != 0 ) {
        $clientPerPage = 20;
        $pageNumber = ceil($clientsNumber/$clientPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $clientPerPage;
        $pagination = paginate('client.php', '?p=', $pageNumber, $p);
        $clients = $clientManager->getClientsByLimits($begin, $clientPerPage);
    } 
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
                                <li><i class="icon-group"></i><a>Clients</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addClient box begin -->
                            <div id="addClient" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Client</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">CodeClient</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeClient" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Type Client</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="typeClient" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Civilité</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="civilite" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nom</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nom" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="adresse" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Rue</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="rue" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Ville</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="ville" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Activité</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="activite" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="email" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Debit</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="debit" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Credit</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="credit" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tel1</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tel1" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Fax</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="fax" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Permis</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="permis" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Date Permis</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="datePermis" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tel2</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="tel2" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Code Region</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeRegion" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Code Commercial</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="codeCommercial" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Situation Familiale</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="situationFamiliale" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">CIN</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="cin" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Date Naissance</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="dateNaissance" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Solvabilite</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="solvabilite" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nombre Incident</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nombreIncident" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="client" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addClient box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Clients</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addClient" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Client
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">Nom</th>
                                                <th class="t10">CIN</th>
                                                <th class="t10">Type</th>
                                                <th class="t10">Activité</th>
                                                <th class="t10">S.Famili</th>
                                                <th class="t10">Tél</th>
                                                <th class="t10">Permis</th>
                                                <th class="t10">Solvabilité</th>
                                                <th class="t10">NbrIncident</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ( $clientsNumber != 0 ) { 
                                            foreach ( $clients as $client ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteClient<?= $client->id() ?>" data-toggle="modal" data-id="<?= $client->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateClient<?= $client->id() ?>" data-toggle="modal" data-id="<?= $client->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $client->nom() ?></td>
                                                <td><?= $client->cin() ?></td>
                                                <td><?= $client->typeClient() ?></td>
                                                <td><?= $client->activite() ?></td>
                                                <td><?= $client->situationFamiliale() ?></td>
                                                <td><?= $client->tel1() ?></td>
                                                <td><?= $client->permis() ?></td>
                                                <td><?= $client->solvabilite() ?></td>
                                                <td><?= $client->nombreIncident() ?></td>
                                            </tr> 
                                            <!-- updateClient box begin -->
                                            <div id="updateClient<?= $client->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Client</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">CodeClient</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeClient"  value="<?= $client->codeClient() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">TypeClient</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="typeClient"  value="<?= $client->typeClient() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Civilite</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="civilite"  value="<?= $client->civilite() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Nom</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nom"  value="<?= $client->nom() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="adresse"  value="<?= $client->adresse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Rue</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="rue"  value="<?= $client->rue() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Ville</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="ville"  value="<?= $client->ville() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Activite</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="activite"  value="<?= $client->activite() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Email</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="email"  value="<?= $client->email() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Debit</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="debit"  value="<?= $client->debit() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Credit</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="credit"  value="<?= $client->credit() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tel1</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tel1"  value="<?= $client->tel1() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Fax</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="fax"  value="<?= $client->fax() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Permis</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="permis"  value="<?= $client->permis() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DatePermis</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="datePermis"  value="<?= $client->datePermis() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tel2</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="tel2"  value="<?= $client->tel2() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeRegion</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeRegion"  value="<?= $client->codeRegion() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CodeCommercial</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="codeCommercial"  value="<?= $client->codeCommercial() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">SituationFamiliale</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="situationFamiliale"  value="<?= $client->situationFamiliale() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Cin</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="cin"  value="<?= $client->cin() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">DateNaissance</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="dateNaissance"  value="<?= $client->dateNaissance() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Solvabilite</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="solvabilite"  value="<?= $client->solvabilite() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">NombreIncident</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="nombreIncident"  value="<?= $client->nombreIncident() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idClient" value="<?= $client->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="client" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClient box end --> 
                                            <!-- deleteClient box begin -->
                                            <div id="deleteClient<?= $client->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Client</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Client : <?= $client->codeClient() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="idClient" value="<?= $client->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="client" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteClient box end --> 
                                            <?php 
                                            }//end foreach 
                                            }//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php if($clientsNumber != 0){ echo $pagination; } ?><br>
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

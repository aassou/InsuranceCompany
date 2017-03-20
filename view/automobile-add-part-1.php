<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $regionActionController = new RegionActionController('region');
    $commercialActionController = new CommercialActionController('commercial');
    //get objects
    $commercials = $commercialActionController->getCommercials();
    $regions = $regionActionController->getRegions();  
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
                                    <h4>Nouvelle Contart Assurance Automobile : Informations Client</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form id="automobile-add-part-1" class="horizontal-form" action="../app/Dispatcher.php" method="POST">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="progress progress-striped progress-success">
                                                    <div style="width: 50%;" class="bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="codeClient">Code Client</label>
                                                    <div class="controls">
                                                        <input required="required" type="text" id="codeClient" name="codeClient" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="typeClient">Type Client</label>
                                                    <div class="controls">
                                                        <select required="required" id="typeClient" name="typeClient" class="m-wrap span12">
                                                            <option value="1">Particulier</option>
                                                            <option value="2">PME</option>
                                                            <option value="3">Grand Compte</option>
                                                            <option value="4">Arrodissement</option>
                                                            <option value="5">Administration</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span1">
                                                <div class="control-group">
                                                    <label class="control-label" for="civilite">Civilité</label>
                                                    <div class="controls">
                                                        <select required="required" id="civilite" name="civilite" class="m-wrap span12">
                                                            <option value="Monsieur">Monsieur</option>
                                                            <option value="Madame">Madame</option>
                                                            <option value="Mademoiselle">Mademoiselle</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span4">
                                                <div class="control-group autocomplet_container">
                                                    <label class="control-label" for="nom">Nom Client</label>
                                                    <div class="controls">
                                                        <input required="required" type="text" id="nom" name="nom" class="m-wrap span12" onkeyup="autocompletClient()">
                                                        <ul id="clientList"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="cin">CIN</label>
                                                    <div class="controls">
                                                        <input type="text" id="cin" name="cin" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="dateCreation">Date de Naissance</label>
                                                    <div class="controls">
                                                        <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                            <input name="dateNaissance" id="dateNaissance" class="m-wrap m-ctrl-small date-picker" type="text" value="<?= date('Y-m-d') ?>" />
                                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="adresse">Adresse</label>
                                                    <div class="controls">
                                                        <input type="text" id="adresse" name="adresse" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="rue">Rue</label>
                                                    <div class="controls">
                                                        <input type="text" id="rue" name="rue" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="ville">Ville</label>
                                                    <div class="controls">
                                                        <input type="text" id="ville" name="ville" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="region">Région</label>
                                                    <div class="controls">
                                                        <select required="required" id="region" name="region" class="m-wrap span12">
                                                            <?php foreach ( $regions as $region ) { ?>    
                                                            <option value="<?= $region->code() ?>"><?= $region->designation() ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="situationFamiliale">Situation Familiale</label>
                                                    <div class="controls">
                                                        <select required="required" id="situationFamiliale" name="situationFamiliale" class="m-wrap span12">
                                                            <option value="Célibataire">Célibataire</option>
                                                            <option value="Marié(e)">Marié(e)</option>
                                                            <option value="Divorcé(e)">Divorcé(e)</option>
                                                            <option value="Veuf/Veuve">Veuf/Veuve</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="activite">Activité</label>
                                                    <div class="controls">
                                                        <input type="text" id="activite" name="activite" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="tel1">Téléphone 1</label>
                                                    <div class="controls">
                                                        <input type="text" id="tel1" name="tel1" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="tel2">Téléphone 2</label>
                                                    <div class="controls">
                                                        <input type="text" id="tel2" name="tel2" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="fax">Fax</label>
                                                    <div class="controls">
                                                        <input type="text" id="fax" name="fax" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Email</label>
                                                    <div class="controls">
                                                        <input type="email" id="email" name="email" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="permis">Permis</label>
                                                    <div class="controls">
                                                        <input type="email" id="permis" name="permis" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="datePermis">Date de Permis</label>
                                                    <div class="controls">
                                                        <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                            <input id="datePermis" name="datePermis" class="m-wrap m-ctrl-small date-picker" type="text" value="<?= date('Y-m-d') ?>" />
                                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="solvabilite">Solvabilité</label>
                                                    <div class="controls">
                                                        <input type="email" id="solvabilite" name="solvabilite" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="nombreIncident">Nombre Incidents</label>
                                                    <div class="controls">
                                                        <input type="email" id="nombreIncident" name="nombreIncident" class="m-wrap span12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="action" value="add">
                                            <input type="hidden" id="idClient" name="idClient" value="">
                                            <input type="hidden" id="generatedCode" name="generatedCode" value="">
                                            <a class="btn black"><i class="m-icon-swapleft m-icon-white"></i> Retour</a>
                                            <button type="submit" class="btn blue">Continuer <i class="m-icon-swapright m-icon-white"></i></button>
                                        </div>
                                    </form>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>
        <script src="../assets/js/autocomplete.js" type="text/javascript"></script>     
        <script>
        jQuery(document).ready( function(){ App.setPage("table_managed"); App.init(); } );
        $("#automobile-add-part-1").validate({
             rules:{
               nomClient: {
                   required: true
               },
               codeClient: {
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

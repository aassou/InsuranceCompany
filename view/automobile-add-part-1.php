<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $regionActionController     = new AppController('region');
    $commercialActionController = new AppController('commercial');
    //get objects
    $commercials = $commercialActionController->getAll();
    $regions     = $regionActionController->getAll();  
    //backwards actions
    $formValues = array();
    if ( isset($_SESSION['form']) and $_SESSION['form']['name'] == 'client' ) {
        $formValues = array(
            'codeClient' => $_SESSION['form']['codeClient'], 
            'typeClient' => $_SESSION['form']['typeClient'],
            'civilite' => $_SESSION['form']['civilite'], 
            'nom' => $_SESSION['form']['nom'], 
            'cin' => $_SESSION['form']['cin'], 
            'dateNaissance' => $_SESSION['form']['dateNaissance'],
            'adresse' => $_SESSION['form']['adresse'],
            'rue' => $_SESSION['form']['rue'],
            'ville' => $_SESSION['form']['ville'],
            'codeRegion' => $_SESSION['form']['codeRegion'],
            'situationFamiliale' => $_SESSION['form']['situationFamiliale'], 
            'activite' => $_SESSION['form']['activite'],
            'tel1' => $_SESSION['form']['tel1'], 
            'tel2' => $_SESSION['form']['tel2'], 
            'fax' => $_SESSION['form']['fax'],
            'email' => $_SESSION['form']['email'], 
            'permis' => $_SESSION['form']['permis'], 
            'datePermis' => $_SESSION['form']['datePermis'], 
            'solvabilite' => $_SESSION['form']['solvabilite'],
            'nombreIncident' => $_SESSION['form']['nombreIncident'], 
            'idClient' => $_SESSION['form']['idClient'],
            );
    }
    else {
    	$formValues = array(
            'codeClient' => '', 
            'typeClient' => '',
            'civilite' => '', 
            'nom' => '', 
            'cin' => '', 
            'dateNaissance' => '',
            'adresse' => '',
            'rue' => '',
            'ville' => '',
            'codeRegion' => '',
            'situationFamiliale' => '', 
            'activite' => '',
            'tel1' => '', 
            'tel2' => '', 
            'fax' => '',
            'email' => '', 
            'permis' => '', 
            'datePermis' => '', 
            'solvabilite' => '',
            'nombreIncident' => '', 
            'idClient' => '',
            );
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
                                <li><i class="icon-briefcase"></i><a href="production.php">Production</a><i class="icon-angle-right"></i></li>
                                <li><i class="icon-truck"></i><a href="contratAuto.php">Automobile</a><i class="icon-angle-right"></i></li>
                                <li><a>Création Contart Assurance Automobile : Informations Client (étape 1/2)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <h4>Création Contart Assurance Automobile : Informations Client (étape 1/2)</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form id="automobile-add-part-1" class="horizontal-form" action="../app/Dispatcher.php" method="POST">
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="codeClient">Code Client <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input required="required" type="text" id="codeClient" name="codeClient" value="<?= $formValues['codeClient'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="typeClient">Type Client <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <select required="required" id="typeClient" name="typeClient" class="m-wrap span12 bold">
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
                                                    <label class="control-label" for="civilite">Civilité <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <select required="required" id="civilite" name="civilite" value="<?= $formValues['civilite'] ?>" class="m-wrap span12 bold">
                                                            <option value="Monsieur">Monsieur</option>
                                                            <option value="Madame">Madame</option>
                                                            <option value="Mademoiselle">Mademoiselle</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span4">
                                                <div class="control-group autocomplet_container">
                                                    <label class="control-label" for="nom">Nom Client <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input required="required" type="text" id="nom" name="nom" value="<?= $formValues['nom'] ?>" class="m-wrap span12 bold" onkeyup="autocompletClient()">
                                                        <ul id="clientList"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="cin">CIN <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" id="cin" name="cin" value="<?= $formValues['cin'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="dateNaissance">Date de Naissance <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                            <input name="dateNaissance" id="dateNaissance" class="m-wrap m-ctrl-small date-picker bold" type="text"  value="<?= $formValues['dateNaissance'] ?>" />
                                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="adresse">Adresse <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" id="adresse" name="adresse" value="<?= $formValues['adresse'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="rue">Rue</label>
                                                    <div class="controls">
                                                        <input type="text" id="rue" name="rue" value="<?= $formValues['rue'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="ville">Ville</label>
                                                    <div class="controls">
                                                        <input type="text" id="ville" name="ville" value="<?= $formValues['ville'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="region">Région</label>
                                                    <div class="controls">
                                                        <select required="required" id="region" name="codeRegion" class="m-wrap span12 bold">
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
                                                        <select required="required" id="situationFamiliale" name="situationFamiliale" class="m-wrap span12 bold">
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
                                                    <label class="control-label" for="activite">Activité <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" id="activite" name="activite" value="<?= $formValues['activite'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="tel1">Téléphone 1 <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" id="tel1" name="tel1" value="<?= $formValues['tel1'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="tel2">Téléphone 2</label>
                                                    <div class="controls">
                                                        <input type="text" id="tel2" name="tel2" value="<?= $formValues['tel2'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="fax">Fax</label>
                                                    <div class="controls">
                                                        <input type="text" id="fax" name="fax" value="<?= $formValues['fax'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span2">
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Email</label>
                                                    <div class="controls">
                                                        <input type="email" id="email" name="email" value="<?= $formValues['email'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="permis">Permis <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" id="permis" name="permis" value="<?= $formValues['permis'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="datePermis">Date de Permis <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                            <input id="datePermis" name="datePermis" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= $formValues['datePermis'] ?>" />
                                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="solvabilite">Solvabilité</label>
                                                    <div class="controls">
                                                        <input type="text" id="solvabilite" name="solvabilite" value="<?= $formValues['solvabilite'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label" for="nombreIncident">Nombre Incidents</label>
                                                    <div class="controls">
                                                        <input type="text" id="nombreIncident" name="nombreIncident" value="<?= $formValues['nombreIncident'] ?>" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="action" value="add">
                                            <input type="hidden" name="source" value="client">
                                            <input type="hidden" id="idClient" name="idClient" value="<?= $formValues['idClient'] ?>">
                                            <input type="hidden" id="generatedCode" name="generatedCode" value="<?= uniqid().date('YmdHis') ?>">
                                            <p class="red-asterisk">* : Champs obligatoires</p>
                                            <a href="contratAuto.php" class="btn black"><i class="m-icon-swapleft m-icon-white"></i> Retour</a>
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
                   required: true,
                   number: true
               },
               cin: {
                   required: true
               },
               adresse: {
                   required: true
               },
               permis: {
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

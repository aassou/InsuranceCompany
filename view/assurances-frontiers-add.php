<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controller
    $tarifsAssurancesFrontiersActionController = new AppController('tarifsAssurancesFrontieres');
    //get objects  
    $tarifsAssurancesFrontiers = $tarifsAssurancesFrontiersActionController->getAll();
    //set a session for form inputs comming from automobile-add-part-1 in case of backwards
    if ( isset($_SESSION['form']) and $_SESSION['form']['name'] == 'contrat' ) {
            
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
                                <li><i class="icon-plane"></i><a href="assurancesFrontiers.php">Assurances Frontières</a><i class="icon-angle-right"></i></li>
                                <li><a><strong>Nouveau Contart Assurance Frontière</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid ">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- BEGIN TAB PORTLET-->   
                            <div class="portlet box blue tabbable">
                                <div class="portlet-title">
                                    <h4>Nouveau Contart Assurance Automobile</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable portlet-tabs">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="portlet_tab1">
                                                <form id="assurances-frontieres-add" class="horizontal-form" action="../app/Dispatcher.php" method="POST">
                                                    <h4 class="red-asterisk">Infos Contrat</h4>
                                                    <hr>
                                                    <div class="row-fluid">
                                                        <div class="span4">
                                                            <div class="control-group">
                                                                <label class="control-label" for="attestation">N° Attestation <sup class="red-asterisk">*</sup></label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" id="attestation" name="attestation" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span4">
                                                            <div class="control-group">
                                                                <label class="control-label" for="police">N° Police <sup class="red-asterisk">*</sup></label>
                                                                <div class="controls">
                                                                    <input required="required" type="text" id="police" name="police" class="m-wrap span12 bold" value="2017/">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span4">
                                                            <div class="control-group">
                                                                <label class="control-label" for="usage">Usage</label>
                                                                <div class="controls">
                                                                    <select required="required" id="usage" name="idUsage" class="m-wrap span12 bold">
                                                                        <?php 
                                                                        foreach ( $tarifsAssurancesFrontiers as $tarifs ) 
                                                                        { 
                                                                            $libellePeriode = "";
                                                                            $periode = 0;
                                                                            if ( $tarifs->periode() <= 10 ) 
                                                                            {
                                                                                $periode = $tarifs->periode();
                                                                                $libellePeriode = "jours";    
                                                                            }
                                                                            else 
                                                                            {
                                                                                $periode = $tarifs->periode()/30;
                                                                                $libellePeriode = "mois";
                                                                            }    
                                                                        ?>    
                                                                        <option value="<?= $tarifs->id() ?>"><?= $tarifs->typeUsage().' : '.$periode.' '.$libellePeriode ?></option>
                                                                        <?php 
                                                                        } 
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div id="sectionAssurances">
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6">
                                                            <div class="control-group">
                                                                <label class="control-label" for="dateEffet">Date Effet</label>
                                                                <div class="controls">
                                                                    <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                        <input name="dateEffet" id="dateEffet" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span6">
                                                            <div class="control-group">
                                                                <label class="control-label" for="dateExpiration">Date Expiration</label>
                                                                <div class="controls">
                                                                    <div class="input-append date" data-date="" data-date-format="yyyy-mm-dd">
                                                                        <input disabled="disabled" name="dateExpiration" id="dateExpiration" class="m-wrap m-ctrl-small date-picker bold" type="text" />
                                                                        <span class="add-on"><i style="cursor: default" onclick="return false;" class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="red-asterisk">Inforamtions Véhicule</h4>
                                                    <hr>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="immatriculation">Immatriculation</label>
                                                                <div class="controls">
                                                                    <input type="text" id="immatriculation" name="immatriculation" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="moteur">Moteur</label>
                                                                <div class="controls">
                                                                    <input type="text" id="moteur" name="moteur" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="chassis">Chassis</label>
                                                                <div class="controls">
                                                                    <input type="text" id="chassis" name="chassis" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="marque">Marque</label>
                                                                <div class="controls">
                                                                    <input type="text" id="marque" name="marque" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="type">Type</label>
                                                                <div class="controls">
                                                                    <input type="text" id="type" name="type" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="typeCarrosserie">Type Carrosserie</label>
                                                                <div class="controls">
                                                                    <input type="text" id="typeCarrosserie" name="typeCarrosserie" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="poidsTotalCharge">Poids Total en Charge</label>
                                                                <div class="controls">
                                                                    <input type="text" id="poidsTotalCharge" name="poidsTotalCharge" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="nombrePlaces">Nombre Places</label>
                                                                <div class="controls">
                                                                    <input type="text" id="nombrePlaces" name="nombrePlaces" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3">
                                                            <div class="control-group">
                                                               <label class="control-label">Remorque</label>
                                                               <div class="controls">
                                                                  <label class="radio"><div class="radio"><span><input type="radio" name="remorque" value="Oui" style="opacity: 0;"></span></div>Oui</label>
                                                                  <label class="radio"><div class="radio"><span class="checked"><input type="radio" name="remorque" value="Non" checked="" style="opacity: 0;"></span></div>Non</label>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3" style="display: none" id="divImmatriculationRemorque">
                                                            <div class="control-group">
                                                                <label class="control-label" for="immatriculationRemorque">Immatriculation Remorque</label>
                                                                <div class="controls">
                                                                    <input type="text" id="immatriculationRemorque" name="immatriculationRemorque" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="cylindre">Cylindre</label>
                                                                <div class="controls">
                                                                    <input type="text" id="cylindre" name="cylindre" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="red-asterisk">Informations Souscripteur / Propriétaire</h4>
                                                    <hr>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="souscripteur">Souscripteur</label>
                                                                <div class="controls">
                                                                    <input type="text" id="souscripteur" name="souscripteur" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="passportSouscripteur">Passeport Souscripteur</label>
                                                                <div class="controls">
                                                                    <input type="text" id="passportSouscripteur" name="passeportSouscripteur" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="cinSouscripteur">CIN Souscripteur</label>
                                                                <div class="controls">
                                                                    <input type="text" id="cinSouscripteur" name="cinSouscripteur" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="permis">Permis</label>
                                                                <div class="controls">
                                                                    <input type="text" id="permis" name="permis" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span3">
                                                            <div class="control-group">
                                                                <label class="control-label" for="datePermis">Delivré le</label>
                                                                <div class="controls">
                                                                    <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                        <input name="datePermis" id="datePermis" class="m-wrap m-ctrl-small date-picker bold" type="text" value="<?= date('Y-m-d') ?>" />
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span1">
                                                            <div class="control-group">
                                                                <label class="control-label" for="categorie">Catégorie</label>
                                                                <div class="controls">
                                                                    <select name="categorie" class="m-wrap span12">
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="C">C</option>
                                                                        <option value="D">D</option>
                                                                        <option value="E">E</option>
                                                                        <option value="F">F</option>
                                                                        <option value="G">G</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="proprietaire">Propriétaire</label>
                                                                <div class="controls">
                                                                    <input type="text" id="proprietaire" name="proprietaire" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="passeport">Passeport Propriétaire</label>
                                                                <div class="controls">
                                                                    <input type="text" id="passeport" name="passeport" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="cin">CIN Propriétaire</label>
                                                                <div class="controls">
                                                                    <input type="text" id="cin" name="cin" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span4">
                                                            <div class="control-group">
                                                                <label class="control-label" for="adresse">Adresse</label>
                                                                <div class="controls">
                                                                    <input type="text" id="adresse" name="adresse" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span2">
                                                            <div class="control-group">
                                                                <label class="control-label" for="pays">Pays</label>
                                                                <div class="controls">
                                                                    <input type="text" id="pays" name="pays" class="m-wrap span12 bold">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="hidden" name="action" value="add">
                                                        <input type="hidden" name="source" value="assurancesFrontiers">
                                                        <div id="brancheSection"></div>
                                                        <input type="hidden" id="generatedCode" name="generatedCode" value="<?= uniqid().date('YmdHis') ?>">
                                                        <p class="red-asterisk">* : Champs obligatoires</p>
                                                        <a href="automobile-add-part-1.php" class="btn black"><i class="m-icon-swapleft m-icon-white"></i> Retour</a>
                                                        <button type="submit" class="btn blue">Terminer <i class="icon-save m-icon-white"></i></button>
                                                    </div>
                                                </form>     
                                            </div>
                                        </div>
                                    </div>
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
        jQuery(document).ready( function(){ 
            App.setPage("table_managed"); 
            App.init();
            $(":input[type='radio']").on("change", function () {
                if ($(this).prop("checked") && $(this).val() != "Oui")
                    $("#divImmatriculationRemorque").hide();
                else
                    $("#divImmatriculationRemorque").show();
            });
            //declare and initialize variables
            var usage, idUsage, sectionAssurances, data, dateEffet, dateExpiration, periode;
            //onload processing begins
            usage             = "#usage";
            idUsage           = $(usage).val();
            sectionAssurances = "#sectionAssurances";
            data              = 'idUsage='+idUsage;
            $.ajax({
                type: "POST",
                url: "../ajax/tarifs-assurances-frontieres.php",
                data: data,
                cache: false,
                success: function(html){
                    $(sectionAssurances).html(html);
                    //Dates sections
                    dateEffet      = $('#dateEffet').val();
                    dateExpiration = $('#dateEffet').val();
                    periode        = +$('#periode').text();
                    dateEffet      = new Date(dateEffet);
                    dateExpiration = new Date(dateExpiration);
                    dateExpiration.setDate(dateEffet.getDate()+periode);
                    $('#dateExpiration').val(dateExpiration.toString('yyyy-MM-dd'));
                }
            });
            //onload processing ends
            //onchange dates begins
            $('#dateEffet').datepicker().on('changeDate', function(){
                dateEffet      = $('#dateEffet').val();
                dateExpiration = $('#dateEffet').val();
                periode        = +$('#periode').text();
                dateEffet      = new Date(dateEffet);
                dateExpiration = new Date(dateExpiration);
                dateExpiration.setDate(dateExpiration.getDate()+periode);
                $('#dateExpiration').val(dateExpiration.toString('yyyy-MM-dd'));    
            });
            //onchange dates ends
            //usage onchange begins
            $('#usage').change(function(){
                usage             = "#usage";
                idUsage           = $(usage).val();
                sectionAssurances = "#sectionAssurances";
                data              = 'idUsage='+idUsage;
                $.ajax({
                    type: "POST",
                    url: "../ajax/tarifs-assurances-frontieres.php",
                    data: data,
                    cache: false,
                    success: function(html){
                        $(sectionAssurances).html(html);
                        //Dates sections
                        dateEffet      = $('#dateEffet').val();
                        dateExpiration = $('#dateEffet').val();
                        periode        = +$('#periode').text();
                        dateEffet      = new Date(dateEffet);
                        dateExpiration = new Date(dateExpiration);
                        dateExpiration.setDate(dateEffet.getDate()+periode);
                        $('#dateExpiration').val(dateExpiration.toString('yyyy-MM-dd'));
                    }
                });
            });
            //usage onchange ends
            $('#attestation').change(function(){
                var attestation = $('#attestation').val();
                $('#police').val('2017/'+attestation);
            });
            //validate form begins
            $("#assurances-frontieres-add").validate({
                 rules:{
                   police: {
                       required: true,
                   },
                   attestation: {
                       required: true,
                   },
                   usage: {
                       required: true
                   }
                 },
                 errorClass: "error-class",
                 validClass: "valid-class"
            });
            //validate form ends
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

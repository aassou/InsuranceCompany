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
                                <li><i class="icon-wrench"></i><a>Paramètrages</a></li>
                            </ul>
                            <div class="tiles">
                                <a href="compagnie.php">
                                    <div class="tile bg-navy">
                                        <div class="tile-body"><i class="icon-sitemap"></i></div>
                                        <div class="tile-object"><div class="name">Compagnies</div></div>
                                    </div>
                                </a>
                                <a href="branche.php">
                                    <div class="tile bg-blue-3">
                                        <div class="tile-body"><i class="icon-list-alt"></i></div>
                                        <div class="tile-object"><div class="name">Branches</div></div>
                                    </div>
                                </a>
                                <a href="usage.php">
                                    <div class="tile bg-blue">
                                        <div class="tile-body"><i class="icon-truck"></i></div>
                                        <div class="tile-object"><div class="name">Usage</div></div>
                                    </div>
                                </a>
                                <a href="classe.php">
                                    <div class="tile bg-blue-2">
                                        <div class="tile-body"><i class="icon-file"></i></div>
                                        <div class="tile-object"><div class="name">Classes</div></div>
                                    </div>
                                </a>
                                <a href="sousClasse.php">
                                    <div class="tile bg-aqua">
                                        <div class="tile-body"><i class="icon-copy"></i></div>
                                        <div class="tile-object"><div class="name">Sous Classes</div></div>
                                    </div>
                                </a>
                                <a href="banque.php">
                                    <div class="tile bg-teal">
                                        <div class="tile-body"><i class="icon-credit-card"></i></div>
                                        <div class="tile-object"><div class="name">Banques</div></div>
                                    </div>
                                </a>
                                <a href="region.php">
                                    <div class="tile bg-olive-2">
                                        <div class="tile-body"><i class="icon-map-marker"></i></div>
                                        <div class="tile-object"><div class="name">Regions</div></div>
                                    </div>
                                </a>
                                <a href="commercial.php">
                                    <div class="tile bg-olive">
                                        <div class="tile-body"><i class="icon-group"></i></div>
                                        <div class="tile-object"><div class="name">Commerciaux</div></div>
                                    </div>
                                </a>
                                <a href="codeReglementSinistre.php">
                                    <div class="tile bg-green">
                                        <div class="tile-body"><i class="icon-ok-sign"></i></div>
                                        <div class="tile-object"><div class="name">ReglementSinistre</div></div>
                                    </div>
                                </a>
                                <a href="expert.php">
                                    <div class="tile bg-lime">
                                        <div class="tile-body"><i class="icon-eye-open"></i></div>
                                        <div class="tile-object"><div class="name">Experts</div></div>
                                    </div>
                                </a>
                                <a href="classeAT.php">
                                    <div class="tile bg-yellow-2">
                                        <div class="tile-body"><i class="icon-list"></i></div>
                                        <div class="tile-object"><div class="name">Classes AT</div></div>
                                    </div>
                                </a>
                                <a href="activiteAT.php">
                                    <div class="tile bg-yellow">
                                        <div class="tile-body"><i class="icon-list-ol"></i></div>
                                        <div class="tile-object"><div class="name">Activités AT</div></div>
                                    </div>
                                </a>
                                <a href="motifRetourQuittance.php">
                                    <div class="tile bg-orange">
                                        <div class="tile-body"><i class="icon-signin"></i></div>
                                        <div class="tile-object"><div class="name">Motif Retour Quittance</div></div>
                                    </div>
                                </a>
                                <a href="tarifRC.php">
                                    <div class="tile bg-red-2">
                                        <div class="tile-body"><i class="icon-barcode"></i></div>
                                        <div class="tile-object"><div class="name">Tarif RC</div></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
        <script>jQuery(document).ready( function(){ App.setPage("sliders"); App.init(); } );</script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>
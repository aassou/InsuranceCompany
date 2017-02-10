<?php
require('../app/classLoad.php');
spl_autoload_register("classLoad"); 
require('../app/PDOFactory.php');  
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
                                    <div class="tile bg-dark-blue">
                                        <div class="tile-body"><i class="icon-sitemap"></i></div>
                                        <div class="tile-object"><div class="name">Compagnies</div></div>
                                    </div>
                                </a>
                                <a href="branche.php">
                                    <div class="tile bg-green">
                                        <div class="tile-body"><i class="icon-list-alt"></i></div>
                                        <div class="tile-object"><div class="name">Branches</div></div>
                                    </div>
                                </a>
                                <a href="usage.php">
                                    <div class="tile bg-grey">
                                        <div class="tile-body"><i class="icon-truck"></i></div>
                                        <div class="tile-object"><div class="name">Usage</div></div>
                                    </div>
                                </a>
                                <a href="classe.php">
                                    <div class="tile bg-blue">
                                        <div class="tile-body"><i class="icon-file"></i></div>
                                        <div class="tile-object"><div class="name">Classes</div></div>
                                    </div>
                                </a>
                                <a href="sousClasse.php">
                                    <div class="tile bg-brown">
                                        <div class="tile-body"><i class="icon-copy"></i></div>
                                        <div class="tile-object"><div class="name">Sous Classes</div></div>
                                    </div>
                                </a>
                                <a href="banque.php">
                                    <div class="tile bg-yellow">
                                        <div class="tile-body"><i class="icon-credit-card"></i></div>
                                        <div class="tile-object"><div class="name">Banques</div></div>
                                    </div>
                                </a>
                                <a href="region.php">
                                    <div class="tile bg-dark-cyan">
                                        <div class="tile-body"><i class="icon-map-marker"></i></div>
                                        <div class="tile-object"><div class="name">Regions</div></div>
                                    </div>
                                </a>
                                <a href="configuration.php">
                                    <div class="tile bg-dark-red">
                                        <div class="tile-body"><i class="icon-wrench"></i></div>
                                        <div class="tile-object"><div class="name">Paramétrages</div></div>
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
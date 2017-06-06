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
                                <li><i class="icon-home"></i><a href="dashboard.php"><strong>Accueil</strong></a></li>
                            </ul>
                            <div class="tiles">
                                <a href="caisse-group.php">
                                    <div class="tile bg-purple">
                                        <div class="tile-body"><i class="icon-money"></i></div>
                                        <div class="tile-object"><div class="name">Caisse</div></div>
                                    </div>
                                </a>
                                <a href="production.php">
                                    <div class="tile bg-green">
                                        <div class="tile-body"><i class="icon-briefcase"></i></div>
                                        <div class="tile-object"><div class="name">Production</div></div>
                                    </div>
                                </a>
                                <a href="charges-communs-grouped.php">
                                    <div class="tile bg-grey">
                                        <div class="tile-body"><i class="icon-signal"></i></div>
                                        <div class="tile-object"><div class="name">Charges</div></div>
                                    </div>
                                </a>
                                <a href="company-cheques.php?idSociete=3">
                                    <div class="tile bg-blue">
                                        <div class="tile-body"><i class="icon-envelope-alt"></i></div>
                                        <div class="tile-object"><div class="name">Chèques</div></div>
                                    </div>
                                </a>
                                <a href="suivi-company.php">
                                    <div class="tile bg-brown">
                                        <div class="tile-body"><i class="icon-bar-chart"></i></div>
                                        <div class="tile-object"><div class="name">Statistiques</div></div>
                                    </div>
                                </a>
                                <a href="status.php">
                                    <div class="tile bg-yellow">
                                        <div class="tile-body"><i class="icon-tasks"></i></div>
                                        <div class="tile-object"><div class="name">Les états</div></div>
                                    </div>
                                </a>
                                <a href="client.php">
                                    <div class="tile bg-dark-cyan">
                                        <div class="tile-body"><i class="icon-group"></i></div>
                                        <div class="tile-object"><div class="name">Clients</div></div>
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
                    <h4 class="breadcrumb"><i class="icon-table"></i> Bilans et Statistiques Pour Cette Semaine</h4>
                    <div class="row-fluid">
                        <div class="span2 responsive" data-tablet="span2" data-desktop="span2">
                            <div class="dashboard-stat red">
                                <div class="visual"><i class="icon-signal"></i></div>
                                <div class="details">
                                    <div class="number"><?= 12 ?></div>
                                    <div class="desc">Régl.Cli</div>
                                </div>					
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span2" data-desktop="span2">
                            <div class="dashboard-stat green">
                                <div class="visual"><i class="icon-shopping-cart"></i></div>
                                <div class="details">
                                    <div class="number">+<?= 12 ?></div>
                                    <div class="desc">Livraisns</div>
                                </div>					
                            </div>
                        </div>
                        <div class="span2 responsive" data-tablet="span2" data-desktop="span2">
                            <div class="dashboard-stat blue">
                                <div class="visual"><i class="icon-group"></i></div>
                                <div class="details">
                                    <div class="number">+<?= 12 ?></div>
                                    <div class="desc">Clients</div>
                                </div>			
                            </div>
                        </div>	
                        <div class="span3 responsive" data-tablet="span3" data-desktop="span3">
                            <a class="more" href="">
                                <div class="dashboard-stat purple">
                                    <div class="visual"><i class="icon-money"></i></div>
                                    <div class="details">
                                        <div class="number"><?= number_format(2000, '2', ',', ' ') ?></div>
                                        <div class="desc">Caisse 1</div>
                                    </div>					
                                </div>
                            </a>
                        </div>
                        <div class="span3 responsive" data-tablet="span3" data-desktop="span3">
                            <a class="more" href="">
                                <div class="dashboard-stat yellow">
                                    <div class="visual"><i class="icon-money"></i></div>
                                    <div class="details">
                                        <div class="number"><?= number_format(3000, '2', ',', ' ') ?></div>
                                        <div class="desc">Caisse 2</div>
                                    </div>                  
                                </div>
                            </a>
                        </div>	
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="portlet paddingless">
                                <div><h4 class="breadcrumb"><i class="icon-bell"></i>&nbsp;Nouveautés</h4></div>
                                <div class="portlet-body">
                                    <div class="tabbable tabbable-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1_1" data-toggle="tab">Les livraisons de la semaine</a></li>
                                            <li><a href="#tab_1_2" data-toggle="tab">Les clients de la semaine</a></li>
                                            <li><a href="#tab_1_3" data-toggle="tab">Notes des clients</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <ul class="feeds">
                                                        <li>
                                                            <div class="col1">
        	                                                   <div class="cont">
        		                                                  <div class="cont-col1">
        			                                                 <div class="desc">	
        				                                                <strong>Fournisseur</strong> : <?= "Mohamed Laamin" ?><br>
        				                                                <strong>Projet</strong> : <?= "Saada" ?><br>
        				                                                <a href="" target="_blank"><strong>Livraison</strong> : <?= 1200 ?></a>
        			                                                 </div>
        		                                                  </div>
        	                                                   </div>
                                                            </div>
                                                            <div class="col2"><div class="date"><?= date('d/m/Y') ?></div></div>
                                                        </li>
                                                        <hr>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_1_2">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <ul class="feeds">
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="desc">	
                                                                            <strong>Client</strong> : <?= "Annouar El Mahi" ?><br>
                                                                            <a href="" target="_blank"><strong>Contrat</strong> : <?= 1212 ?></a>
                                                                            <br>
        				                                                    <strong>Projet</strong> : <?= "Ikhlas" ?>
        				                                                    <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2"><div class="date"><?= date('d/m/Y') ?></div></div>
                                                        </li>
                                                        <hr>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_1_3">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <ul class="feeds">
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success"><i class="icon-bell"></i></div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">	
                                                                            <strong>Note</strong> : <?= "Note 1" ?><br>
                                                                            <strong>Client</strong> : <?= "Chafik TaiTai" ?>
                                                                            <br>
                                                                            <a href="" target="_blank"><strong>Contrat</strong> : <?= 3920 ?></a>
                                                                            <br> 
        				                                                    <strong>Projet</strong> : <?= "Saham" ?>
        			                                                     </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2"><div class="date"><?= date('d/m/Y') ?></div></div>
                                                        </li>
                                                        <hr>
                                                    </ul>
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
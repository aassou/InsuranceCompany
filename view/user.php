<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
    //create Controllers
    $userController = new AppController('user');
    //objects and vars
    $users = $userController->getAll();
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
                                <li><i class="icon-group"></i><a>Utilisateur</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addIndividuelConducteur box begin -->
                            <div id="addUser" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Utilisateur</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Login</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="login" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Mot de passe</label>
                                            <div class="controls">
                                                <input required="required" type="password" name="password" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Retapez Mot de passe</label>
                                            <div class="controls">
                                                <input required="required" type="password" name="rpassword" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Profil</label>
                                            <div class="controls">
                                                <select name="profil">
                                                    <option value="user">Utilisateur</option>
                                                    <option value="consultant">Consultant</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="admin">Administrateur</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="user" />
                                                <input type="hidden" name="status" value="1" />  
                                                <input type="hidden" name="created" value="<?= date('Y-m-d') ?>" />
                                                <input type="hidden" name="createdBy" value="<?= $_SESSION['userAxaAmazigh']->login() ?>" />        
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addIndividuelConducteur box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Utilisateurs</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addUser" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Utilisateur
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t20">Actions</th>
                                                <th class="t20">Login</th>
                                                <th class="t20">Profile</th>
                                                <th class="t20 hidden-phone">Date de création</th>
                                                <th class="t20 hidden-phone">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ( $users as $user ) {
                                                $status = '<span class="label label-important">Inactif</span>';
                                                $classStatus = 'btn mini blue';
                                                $message = '<i class="icon-unlock"></i>';
                                                $changeStatusTo = 1;
                                                if ( $user->status() == 1 ) {
                                                    $status = '<span class="label label-success">Actif</span>';
                                                    $classStatus = 'btn mini black';
                                                    $message = '<i class="icon-lock"></i>';
                                                    $changeStatusTo = 0;    
                                                }   
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="#deleteUser<?= $user->id() ?>" data-toggle="modal" data-id="<?= $user->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateUserProfil<?= $user->id() ?>" data-toggle="modal" data-id="<?= $user->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#updateUserStatus<?= $user->id() ?>" class="<?= $classStatus ?>" data-toggle="modal" data-id="<?= $user->id() ?>"><?= $message ?></a>
                                                </td>
                                                <td><?= $user->login()?></td>
                                                <td><?= $user->profil()?></td>
                                                <td class="hidden-phone"><?= date('d/m/Y', strtotime($user->created())) ?></td>
                                                <td class="hidden-phone"><?= $status ?></td>
                                            </tr> 
                                            <!-- updateUserProfil box begin -->
                                            <div id="updateUserProfil<?= $user->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Profil Utilisateur</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Profil</label>
                                                            <div class="controls">
                                                                <select name="profil">
                                                                    <option value="<?= $user->profil() ?>"><?= $user->profil() ?></option>
                                                                    <option disabled="disabled">--------------------</option>
                                                                    <option value="user">user</option>
                                                                    <option value="consultant">consultant</option>
                                                                    <option value="manager">manager</option>
                                                                    <option value="admin">administrateur</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $user->id() ?>" />
                                                                <input type="hidden" name="action" value="updateProfil" />
                                                                <input type="hidden" name="source" value="user" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateUserProfil box begin --> 
                                            <!-- updateUserStatus box begin -->
                                            <div id="updateUserStatus<?= $user->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Status Utilisateur</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir modifier le status de : <?= $user->login() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $user->id() ?>" />
                                                                <input type="hidden" name="status" value="<?= $changeStatusTo ?>" />
                                                                <input type="hidden" name="action" value="updateStatus" />
                                                                <input type="hidden" name="source" value="user" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteUser box end --> 
                                            <!-- deleteUser box begin -->
                                            <div id="deleteUser<?= $user->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Utilisateur</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer cette utilisateur : <?= $user->login() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $user->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="user" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteUser box end --> 
                                            <?php 
                                            }//end foreach
                                            ?>
                                        </tbody>
                                    </table>
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

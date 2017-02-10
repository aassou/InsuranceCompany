<?php
session_start();
if ( isset($_SESSION['userAxaAmazigh']) ) {
	header('Location:view/dashboard.php');
}
else {
?>
<!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <title>AxaAmazigh - Management Application</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/metro.css" rel="stylesheet" />
        <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/style_responsive.css" rel="stylesheet" />
        <link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
        <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
        <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
        <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body class="login">
        <div class="logo">
            <img src="assets/img/logo-index.png" alt="" /> 
        </div>
        <div class="content">
            <form class="form-vertical login-form" action="app/Dispatcher.php" method="POST">
                <h3 class="form-title">Accéder à votre compte</h3>
                <?php if ( isset($_SESSION['actionMessage']) ) { ?>			
                <div class="alert alert-<?= $_SESSION['typeMessage'] ?>">
        	        <button class="close" data-dismiss="alert"></button>
                    <span><?= $_SESSION['actionMessage'] ?></span>
                </div>
                <?php } unset($_SESSION['actionMessage']) ?>	
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Login</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input class="m-wrap" type="text" name="login"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Mot de passe</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap" type="password" name="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="source" value="user">
                    <input type="submit" class="btn green pull-right" value="Se connecter">            
                </div>
            </form>
        </div>
        <div class="copyright">
            <?= date('Y') ?> &copy; AxaAmazigh. Management Application.
        </div>
        <script src="assets/js/jquery-1.8.3.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>  
        <script src="assets/uniform/jquery.uniform.min.js"></script> 
        <script src="assets/js/jquery.blockui.js"></script>
        <script type="text/javascript" src="assets/jquery-validation/dist/jquery.validate.min.js"></script>
    </body>
</html>
<?php } ?>
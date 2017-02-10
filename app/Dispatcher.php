<?php
    //classes loading begin
    function classLoad ($myClass) {
        if(file_exists('../model/'.$myClass.'.php')){
            include('../model/'.$myClass.'.php');
        }
        elseif(file_exists('../controller/'.$myClass.'.php')){
            include('../controller/'.$myClass.'.php');
        }
    }
    spl_autoload_register("classLoad"); 
    include('../app/PDOFactory.php');  
    include('../lib/ImageProcessing.php');
    //classes loading end
    session_start();
    //post input processing
    $action = htmlentities($_POST['action']);
    $source = htmlentities($_POST['source']);
    //Components Porcessing
    //Step 1: Generate components names
    $component = ucfirst($source);
    $componentController = ucfirst($component)."ActionController";
    //Step 2 : Create new components
    $componentController = new $componentController($source);
    $componentController->$action($_POST);
    $source = $componentController->source();
    //Step 3 : Send response
    $_SESSION['actionMessage'] = $componentController->actionMessage();
    $_SESSION['typeMessage'] = $componentController->typeMessage();
    header('Location:../view/'.$source.".php");
    

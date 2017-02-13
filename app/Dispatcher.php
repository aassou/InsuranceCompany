<?php
    include('classLoad.php');
    //classes loading end
    session_start();
    //post input processing
    $action = htmlentities($_POST['action']);//add or update or delete
    $source = htmlentities($_POST['source']);//automobile
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
    

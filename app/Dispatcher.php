<?php
include('classLoad.php');
//classes loading end
session_start();
//post input processing
$action = htmlentities($_POST['action']);//this parameter's used to let the dispatcher decide the action to take
$sourceName = htmlentities($_POST['source']);//this parameter's used to know from which view comes this request
$pageNumber = "";//this parameter is used in case of views with pagination, we added it to our source
if ( isset($_POST['pageNumber']) ) { $pageNumber = "?p=".htmlentities($_POST['pageNumber']); } 
//Components Porcessing
//Step 1: Generate components names
$component = ucfirst($sourceName);
$componentController = ucfirst($component)."ActionController";
//Step 2 : Create new components
$componentController = new AppController($sourceName);
$componentController->$action($_POST);
$source = $componentController->source();
//Step 3 : Send response
$_SESSION['actionMessage'] = $componentController->actionMessage();
$_SESSION['typeMessage'] = $componentController->typeMessage();
$_SESSION['form'] = $_POST; //this session is used to store form's fields for backwards actions
$_SESSION['form']['name'] = $sourceName;
header('Location:../'.$source.$pageNumber);

<?php
spl_autoload_register(function ($myClass){
    if(file_exists('../model/'.$myClass.'.php')){
        include('../model/'.$myClass.'.php');
    }
    if(file_exists('../controller/'.$myClass.'.php')){
        include('../controller/'.$myClass.'.php');
    }
    if(file_exists('../app/'.$myClass.'.php')){
        include('../app/'.$myClass.'.php');
    }
    if(file_exists('../lib/'.$myClass.'.php')){
        include('../lib/'.$myClass.'.php');
    }
});
require('../lib/pagination.min.php');

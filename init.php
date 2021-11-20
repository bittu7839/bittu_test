<?php
    session_start();
    spl_autoload_register(function($className){
        include "classes/".$className.".php";
    });

    $source = new Source;
    $validate = new Validation();
?>
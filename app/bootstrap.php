<?php
//Load Config
require_once 'config/config.php';
require_once 'helpers/session_helper.php';

    spl_autoload_register(function($className){
            require_once 'libraries/'.$className.'.php';
    });




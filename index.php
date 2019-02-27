<?php

    define("ROOT", __DIR__);
    include(ROOT . "/config/config.php");
    
    mb_http_input('UTF-8');
    mb_http_output('UTF-8');
    mb_internal_encoding("UTF-8");
    
    spl_autoload_register(function($className) {
        $dirs = [
            ROOT . "/core/",
            ROOT . "/controllers/",
            ROOT . "/models/",
        ];
        foreach($dirs as $dir) {
            if (is_file($dir . $className . ".php")) {
                include $dir . $className . ".php";
                break;
            }
        }
    });
    
    
    DB::connect();
    session_start();
    $app = new Application();
    
    $app->run();
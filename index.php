<?php 

    // FRONT CONTROLLER

    $string = '21-11-2015 <br><hr><br>';

    // $pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
    // $replacement = "Month: $2, Day: $1, Year: $3";
    // echo preg_replace($pattern, $replacement, $string);
    
    // 1. General settings
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // 2. Connecting files
    define('ROOT', dirname(__FILE__));
    require_once(ROOT.'/components/Router.php');
    require_once(ROOT.'/components/Db.php');

    // 3. Connecting db

    // 4. Call Router
    $router = new Router();
    $router->run();

?>
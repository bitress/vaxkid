<?php

if (function_exists("date_default_timezone_set")) {
    if (ini_get("date.timezone") === "") {
        date_default_timezone_set("Asia/Manila");
    }
}

include_once 'Configuration.php';
require __DIR__.'/../vendor/autoload.php';
require __DIR__. '/../fpdf/fpdf.php';
// using autoloader so i dont have to repeatedly include_once the newly created classes
spl_autoload_register(function ($class) {
    $file = __DIR__. '/../VaxEngine/'. $class .'.php';

    if(is_file($file)){
        include_once $file;
    }

});

// Start the Session
Session::startSession();

// init Login Class
$login = new Login();

// Initialise the Database Class
$db = Database::getInstance();


if ($login->isLoggedIn()){
    $user = new User();
    $u = $user->getData();
}

<?php
//Set up initialisation on each page to define start sessions,set config, auto load classes and include functions like verify.

date_default_timezone_set('Etc/GMT');
  session_start();

// Array of config settings to keep consitency, to allow data to be pulled easily from different classes
  $GLOBALS['config'] = array(
      'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'seprojectgroup48'
      ),

      'session' => array(
        'session_name' => 'account',
        //Allows  to create static method to generate token
        'token_name' => 'token'
      )
    );

//Pass function that runs when a class is accessed(standard php library)
spl_autoload_register(function($class) {
    require_once 'classes/'. $class. '.php';
});

//Include functions in functions Directory
require_once 'functions/verify.php';

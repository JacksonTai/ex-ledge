<?php

spl_autoload_register(function ($classname) {

     $url = $_SERVER['REQUEST_URI'];

     strpos($url, 'app/view') ?  $path = '../../' : $path = '../';
     
     $file = $path . $classname . '.php';

     if (file_exists($file)) {
          try {
               require_once $file;
          } catch (ErrorException $e) {
               echo 'Autoloader Failed' . $e->getMessage();
          }
     }
});

<?php

spl_autoload_register(function ($classname) {
  
     $file = '../' . $classname . '.php';
   
     if (file_exists($file)) {
          try {
               require_once $file;
          } catch (ErrorException $e) {
               echo 'Autoloader Failed' . $e->getMessage();
          }
     }
});

<?php

namespace Model;

include '../helper/autoloader.php';

class Signin extends \config\DbConn
{
     private $postData = [];
     private $errMsg = [
          'email' => '',
          'password' => '',
          'invalidCredentials' => '',
     ];

     protected function __construct($postData)
     {
          $this->postData = $postData;
     }
}

<?php

namespace Controller;

include '../helper/autoloader.php';

class Signin extends \Model\Signin
{
     public function __construct($postData)
     {
          $errMsg = parent::__construct($postData);
          echo json_encode($errMsg);
     }
}

new \Controller\Signin($_POST);

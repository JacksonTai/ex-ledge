<?php

namespace Controller;

include '../helper/autoloader.php';

class Signup extends \Model\Signup
{
     public function __construct($postData)
     {
          $errMsg = parent::__construct($postData);
          if (is_array($errMsg)) {
               echo json_encode($errMsg);
          } else {
               echo json_encode(false);
          }
     }
}

new \Controller\Signup($_POST);

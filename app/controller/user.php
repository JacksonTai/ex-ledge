<?php

namespace Controller;

include '../helper/autoloader.php';

class User extends \Model\User
{
     public function __construct($postData = null) 
     {
          if ($postData) {
               $errMsg = parent::__construct($postData);
               if (is_array($errMsg)) {
                    echo json_encode($errMsg);
               } else {
                    header('Location: ../../public/index.php');
               }
          }
     }
}

$newUser = new \Controller\User($_POST);

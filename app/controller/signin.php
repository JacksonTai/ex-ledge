<?php

namespace Controller;


if (!empty($_GET) || !empty($_POST)) {
     include '../helper/autoloader.php';
}


class Signin extends \Model\Signin
{
     public function __construct($postData = null)
     {
          if ($postData) {
               $errMsg = parent::__construct($postData);
               echo json_encode($errMsg);
          }
     }

     public function authenticate($email, $password)
     {
          return $this->checkCredential($email, $password);
     }
}

!empty($_POST) ? new \Controller\Signin($_POST) : null;

if (isset($_GET['email'], $_GET['password'])) {
     $user = new \Controller\Signin();
     echo json_encode($user->authenticate($_GET['email'], $_GET['password']));
}

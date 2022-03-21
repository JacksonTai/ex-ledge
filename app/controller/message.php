<?php

namespace Controller;

if (!empty($_GET)) {
     session_start();
     include '../helper/autoloader.php';
}

class Message extends \Model\Message
{
     public function __construct($data = null)
     {
          $data ? parent::__construct($data) : '';
     }

     public function read()
     {
     }
}

if (!empty($_GET)) {
     $user = new \Controller\User($_GET);
     // echo json_encode();
}

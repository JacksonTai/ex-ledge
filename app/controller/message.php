<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     session_start();
     include '../helper/autoloader.php';
}

class Message extends \Model\Message
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function read($getData)
     {
          return $this->getMsg($getData);
     }
}

!empty($_POST) ? new \Controller\Message($_POST) : null;

if (isset($_GET['senderId'], $_GET['receiverId'])) {
     $msg = new \Controller\Message();
     $result = $msg->read($_GET);
     echo json_encode($result);
}

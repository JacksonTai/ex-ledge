<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     if (!isset($_GET['id'])) {
          session_start();
          include '../helper/autoloader.php';
     }
}

class User extends \Model\User
{
     public function __construct($userId = null)
     {
          $userId ? parent::__construct($userId) : '';
     }

     public function read($userId = null)
     {
          return $this->getUser($userId);
     }

     public function search($searchTerm)
     {
          return $this->searchUser($searchTerm);
     }

     public function readMessagedUser($receiverId = null)
     {
          return $this->getMessagedUser($receiverId);
     }
}

!empty($_POST) ? new \Controller\Message($_POST) : null;

if (isset($_GET['userId'])) {
     $user = new \Controller\User();
     echo json_encode($user->read($_GET['userId']));
}

if (isset($_GET['searchTerm'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->search($_GET['searchTerm']));
}

if (isset($_GET['senderId'])) {
     $user = new \Controller\User($_GET['senderId']);
     if (isset($_GET['receiverId'])) {
          echo json_encode($user->readMessagedUser($_GET['receiverId']));
          exit();
     }
     echo json_encode($user->readMessagedUser());
}

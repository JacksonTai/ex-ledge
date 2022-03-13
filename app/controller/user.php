<?php

namespace Controller;

if (!empty($_GET)) {
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
}

if (isset($_GET['searchTerm'])) {
     $user = new \Controller\User($_SESSION['userId']);
     $result = $user->search($_GET['searchTerm']);
     print_r($result);
}

if (isset($_GET['userId'])) {
     $user = new \Controller\User();
     $result = $user->read($_GET['userId']);
     echo json_encode($result);
}

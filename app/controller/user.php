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

     public function update($postData)
     {
          return $this->updateUser($postData);
     }

     public function delete($userId)
     {
          return $this->deleteUser($userId);
     }
}

if (isset($_POST['username'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->update($_POST));
}

if (isset($_GET['bio'])) {
     $user = new \Controller\User($_SESSION['userId']);
     $user->update($_GET);
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

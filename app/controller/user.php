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

     public function verify($postData)
     {
          return $this->verifyUser($postData);
     }

     public function readVerification($userId = null)
     {
          return $this->getVerification($userId);
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
          $this->deleteUser($userId);
     }
}

if (isset($_POST['fullName'], $_POST['nric'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->verify($_POST));
     // print_r($user->verify($_POST));
}

if (isset($_GET['userId'])) {
     $user = new \Controller\User();
     $result = $user->read($_GET['userId']);
     echo json_encode($result);
}

if (isset($_GET['searchTerm'])) {
     $user = new \Controller\User($_SESSION['userId']);
     $result = $user->search($_GET['searchTerm']);
     print_r($result);
}

if (isset($_POST['username'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->update($_POST));
}

if (isset($_GET['bio'])) {
     $user = new \Controller\User($_SESSION['userId']);
     $user->update($_GET);
}

if (isset($_GET['deleteId'])) {
     $user = new \Controller\User();
     $user->delete($_GET['deleteId']);
}

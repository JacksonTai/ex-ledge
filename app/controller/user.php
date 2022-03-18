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

     public function readMessagedUser($receiverId = null)
     {
          return $this->getMessagedUser($receiverId);
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

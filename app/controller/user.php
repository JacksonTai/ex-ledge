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

     /* ######### CREATE ######### */
     public function verify($postData)
     {
          return $this->verifyUser($postData);
     }

     /* ######### READ ######### */
     public function read($userId = null)
     {
          return $this->getUser($userId);
     }

     /**
      * This function helps to read the users' rank.
      * @param integer $top [optional]
      *  - Gets specified top user.  
      *  Example: getUserRank(5) will return top 5 user.
      * @param integer $length [optional]
      *  - Gets specified top user range.
      *  Example: getUserRank(4, 10) will return top 4 until 10 user.
      */
     public function readRank($top = null, $length = null)
     {
          return $this->getUserRank($top, $length);
     }

     public function readVerification($userId = null)
     {
          return $this->getVerification($userId);
     }

     public function search($searchTerm)
     {
          return $this->searchUser($searchTerm);
     }

     /* ######### UPDATE ######### */
     public function update($postData)
     {
          return $this->updateUser($postData);
     }

     /* ######### DELETE ######### */
     public function delete($userId)
     {
          $this->deleteUser($userId);
     }
}

/* ######### CREATE ######### */
if (isset($_POST['fullName'], $_POST['nric'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->verify($_POST));
}

/* ######### READ ######### */
if (isset($_GET['userId'])) {
     $user = new \Controller\User();
     echo json_encode($user->read($_GET['userId']));
}

if (isset($_GET['searchTerm'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->search($_GET['searchTerm']));
}

/* ######### UPDATE ######### */
if (isset($_POST['username'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->update($_POST));
}

if (isset($_GET['bio'])) {
     $user = new \Controller\User($_SESSION['userId']);
     $user->update($_GET);
}

/* ######### DELETE ######### */
if (isset($_GET['deleteId'])) {
     $user = new \Controller\User();
     $user->delete($_GET['deleteId']);
}

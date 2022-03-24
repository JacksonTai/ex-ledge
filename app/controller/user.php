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
     public function read($criteria = null)
     {
          return $this->getUser($criteria);
     }

     public function loadUsers($limit, $start)
     {
          return $this->loadData($limit, $start);
     }

     /**
      * This function return the users' rank.
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

     /**
      * This function return the total points of user by summing
      * the total points of answer and question provided by the
      * user.
      * @param string $userId  
      */
     public function readPoint($userId)
     {
          return $this->getUserPoint($userId);
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
     public function updateDetail($postData)
     {
          return $this->updateUserDetail($postData);
     }

     /**
      * This function set user point.
      * @param integer $value  
      */
     public function setPoint($value)
     {
          $this->setUserPoint($value);
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

if (isset($_POST["limit"], $_POST["start"])) {
     $user = new \Controller\User();
     return $user->loadUsers($_POST["limit"], $_POST["start"]);
}

if (isset($_GET['searchTerm'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->search($_GET['searchTerm']));
}

/* ######### UPDATE ######### */
if (isset($_POST['username'])) {
     $user = new \Controller\User($_SESSION['userId']);
     echo json_encode($user->updateDetail($_POST));
}

if (isset($_GET['bio'])) {
     $user = new \Controller\User($_SESSION['userId']);
     $user->updateDetail($_GET);
}

/* ######### DELETE ######### */
if (isset($_GET['deleteId'])) {
     $user = new \Controller\User();
     $user->delete($_GET['deleteId']);
}

<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     if (
          !isset($_GET['search']) &&
          !isset($_GET['searchTxt']) &&
          !isset($_GET['noAns']) &&
          !isset($_GET['noAcceptedAns']) &&
          !isset($_GET['sort']) &&
          !isset($_GET['id']) && !isset($_GET['page'])
     ) {
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

     public function loadUsers($limit, $start, $username)
     {
          return $this->loadData($limit, $start, $username);
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

     public function readMessagedUser($receiverId = null)
     {
          return $this->getMessagedUser($receiverId);
     }

     public function userCount($criteria = null)
     {
          return $this->getUserCount($criteria);
     }

     public function verifiedRatio()
     {
          return $this->getVerifiedRatio();
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

     public function updateVerif($userId)
     {
          $this->updateUserVerif($userId);
     }

     /* ######### DELETE ######### */
     public function delete($userId)
     {
          $this->deleteUser($userId);
     }

     public function deleteVerif($userId)
     {
          $this->deleteUserVerif($userId);
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

if (isset($_POST["limit"], $_POST["start"], $_POST['searchTerm'])) {
     $user = new \Controller\User();
     return $user->loadUsers($_POST["limit"], $_POST["start"], $_POST['searchTerm']);
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

if (isset($_GET['verifId'], $_GET['nricNo'])) {
     $user = new \Controller\User();
     $user->updateVerif($_GET);
}

if (isset($_GET['rejectverifId'])) {
     $user = new \Controller\User();
     $user->deleteVerif($_GET['rejectverifId']);
}

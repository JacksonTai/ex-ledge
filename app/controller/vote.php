<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     session_start();
     include '../helper/autoloader.php';
}

class Vote extends \Model\Vote
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function readPrevVote($userId, $voteFor, $id = null)
     {
          return $this->getPrevVote($userId, $voteFor, $id);
     }

     /**
      * This function read and set the user point.
      * @param string $id  
      * Answer or question ID
      */
     public function updatePoint($id)
     {
          $this->updateUserPoint($id);
     }
}

if (isset($_GET['voteType'], $_GET['id'])) {
     $_GET['userId'] = $_SESSION['userId'];
     new \Controller\Vote($_GET);
}

if (isset($_GET['voteFor'])) {
     $vote = new \Controller\Vote();
     if (isset($_GET['id'])) {
          echo json_encode($vote->readPrevVote(
               $_SESSION['userId'],
               $_GET['voteFor'],
               $_GET['id']
          ));
     } else {
          echo json_encode($vote->readPrevVote(
               $_SESSION['userId'],
               $_GET['voteFor']
          ));
     }
}

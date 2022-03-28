<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     if (!isset($_GET['id'])) {
          if (!isset($_POST["limit"], $_POST["start"])) {
               session_start();
               include '../helper/autoloader.php';
          }
     }
}

class Answer extends \Model\Answer
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function read($criteria = null, $status = null)
     {
          return $this->readAnswer($criteria, $status);
     }

     public function answerCount($criteria = null)
     {
          return $this->getAnswerCount($criteria);
     }

     public function accepted()
     {
          return $this->getAcceptedAns();
     }

     public function updateStatus($answerId)
     {
          return  $this->updateAnswerStatus($answerId);
     }
}

if (isset($_GET['questionId'], $_GET['status'])) {
     $answer = new \Controller\Answer();
     echo json_encode($answer->read($_GET['questionId'], $_GET['status']));
     // print_r json_encode
}

if (isset($_GET['acceptId'])) {
     $answer = new \Controller\Answer();
     print_r($answer->updateStatus($_GET['acceptId']));
}
